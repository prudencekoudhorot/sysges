<?php

namespace App\Http\Controllers;

use App\Models\DetailsInventaires;
use App\Models\Inventaires;
use App\Models\RestesProduits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class InventairesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retourne sur la liste des entrées effectuées
        $inventaires = Inventaires::orderBy('id', 'desc')->get();
        return view('inventaire/index',compact('inventaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        //retourne le formulaire d'enregistrement des produits
        $user = auth()->user();
        $user_role = $user->roles_id;
        if((Auth::check())AND(($user_role == "1")OR($user_role == "3"))){
            $inventaires = RestesProduits::all();
            $users = User::where('roles_id', 2)->orderBy('name', 'desc')->get();
            return view('inventaire/create', compact('inventaires','users'));
            }else{
                redirect()->route('login')->with('error','Vous devez être connecter pour accéder à cette ressource');
            }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd()
        $user = auth()->user();
        $inventaire = new Inventaires();
        $inventaire->setAttribute('inventories_id', $request->inventories_id);
        $inventaire->setAttribute('date_inventaire', new \DateTime());
        $inventaire->setAttribute('created_by', $user->id);
        $inventaire->setAttribute('created_at', new \DateTime());
        $inventaire->save();

        if($inventaire){

            if (!empty($request->articles_id)){

                $tab_quantite_reste = $request->quantite_reste;
                $tab_quantite_inventorie = $request->quantite_inventorie;
                $tab_observation = $request->observation;
                $articles_id = $request->articles_id;
                foreach ($articles_id as $key => $value) {
                    if(!empty ($value) && !empty ($tab_quantite_inventorie[$key]) ){
                        $ecart = $tab_quantite_reste[$key] - $tab_quantite_inventorie[$key];
                        $details = new DetailsInventaires();
                        $details->setAttribute('articles_id', $value);
                        $details->setAttribute('quantite_reste', $tab_quantite_reste[$key]);
                        $details->setAttribute('quantite_inventorie', $tab_quantite_inventorie[$key]);
                        $details->setAttribute('ecart', $ecart);
                        $details->setAttribute('observation', $tab_observation[$key]);
                        $details->setAttribute('inventaires_id', $inventaire->id);
                        $details->setAttribute('created_by', $user->id);
                        $details->setAttribute('created_at', new \DateTime());
                        $details->save();

                    }

                }
                return redirect()->route('inventaire.index')->with('success', 'Enregistrement effectué avec succès');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaires  $inventaires
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaires $inventaires, $id)
    {
        //
        $details = DetailsInventaires::where('inventaires_id', $id)->get();
        return view('inventaire/details', compact('details','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaires  $inventaires
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaires $inventaires)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventaires  $inventaires
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventaires $inventaires)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaires  $inventaires
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaires $inventaires)
    {
        //
    }

    public function trie(){
        return view('inventaire.triexport');
    }

    public function exportpdf(Request $request){
        $inventaires = Inventaires::select('inventaires.*')
            ->whereDate('created_at','>=',$request->date_debut)
            ->whereDate('created_at','<=',$request->date_fin)
            ->orderBy('created_at','asc')
            ->get();
//dd($sorties);
        $pdf = PDF::loadView('inventaire/export', compact('inventaires'));
    //   $pdf->setPaper('A4', 'landscape');
         $pdf->setPaper('A4', 'portrait');
         $date = date('Ymd-His');

          // ##### pagination ###############
          $pdf->output();
          $dom_pdf = $pdf->getDomPDF();
          $canvas = $dom_pdf->get_canvas();
          $footer = $canvas->open_object();
          $w = $canvas->get_width();
          $h = $canvas->get_height();
          $canvas->page_text($w-92,$h-52, "Page {PAGE_NUM} sur {PAGE_COUNT}", null, 8, array(0, 0, 0));
          $canvas->close_object();
          $canvas->add_object($footer,"all");
          // ##### end pagination ###############


         $name = "export-inventaire"."-". $date .".pdf";
         return $pdf->download($name);
    }
}
