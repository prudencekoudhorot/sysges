<?php

namespace App\Http\Controllers;

use App\Models\DetailsEntrees;
use App\Models\EntreesProduits;
use App\Models\Produits;
use App\Models\RestesProduits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class EntreesProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retourne sur la liste des entrées effectuées
        $entrees = EntreesProduits::orderBy('id', 'desc')->get();
        return view('entree/index',compact('entrees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retourne le formulaire d'enregistrement des produits
        $user = auth()->user();
        $user_role = $user->roles_id;
        if((Auth::check())AND(($user_role == "1")OR($user_role == "2"))){
        $produits = Produits::orderBy("libelle","asc")->get();

        return view('entree/create', compact('produits'));
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
        //enregistrer les informations liées à une entrée et les informations le concernant

        //enregistrer les informations liées à l'entrée
        $user = auth()->user();
        //requête de récupération et de nommage d'image
        $name_image = null;
        if ($request->path_bordereau) {  /*session documenst*/


            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
            $images = $request->path_bordereau;


                $extension = $images->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if ($check) {

                     $name_image = 'entree'.date('Ymd-His').'-'.$request->date_reception. '.' .$images->extension();
                     $images->move(public_path('storage'), $name_image); /* vérifie si le document de dépot existe sinon ça crée ça*/

                    //  echo "Upload Successfully";
                }

        }
        $entree = new EntreesProduits();
        $entree->setAttribute('reference', $request->reference);
        $entree->setAttribute('date_reception', $request->date_reception);
        $entree->setAttribute('path_bordereau', $name_image);
        $entree->setAttribute('created_by', $user->id);
        $entree->setAttribute('created_at', new \DateTime());
        $entree->save();

        if($entree){

            if (!empty($request->articles_id)){

                $tab_quantite = $request->quantite;
                $tab_prix_unitaire = $request->prix_unitaire;
                $tab_observation = $request->observation;
                $articles_id = $request->articles_id;

                foreach ($articles_id as $key => $value) {

                    if(!empty ($value) && !empty ($tab_quantite[$key]) ){
                        $prix_total = $tab_quantite[$key] * $tab_prix_unitaire[$key];
                        $details = new DetailsEntrees();
                        $details->setAttribute('articles_id', $value);
                        $details->setAttribute('quantite', $tab_quantite[$key]);
                        $details->setAttribute('prix_unitaire', $tab_prix_unitaire[$key]);
                        $details->setAttribute('prix_total', $prix_total);
                        $details->setAttribute('reference', $entree->reference);
                        $details->setAttribute('observation', $tab_observation[$key]);
                        $details->setAttribute('entrees_id', $entree->id);
                        $details->setAttribute('created_by', $user->id);
                        $details->setAttribute('created_at', new \DateTime());
                        $details->save();

                        if($details){

                            $reste = RestesProduits::where('articles_id',$value)->first();

                            if(empty($reste)){
                                $produit = new RestesProduits();
                                $produit->setAttribute('articles_id', $value);
                                $produit->setAttribute('quantite', $tab_quantite[$key]);
                                $produit->setAttribute('created_by', $user->id);
                                $produit->setAttribute('created_at', new \DateTime());
                                $produit->save();
                            }else{
                                $id = $reste->id;
                                //dd($tab_quantite[$key]);
                                $oldquantite = $reste->quantite;
                                $newquantite = $tab_quantite[$key];
                                $quantite = $oldquantite + $newquantite;

                                $produit = RestesProduits::find($id);
                                $produit->setAttribute('quantite', $quantite);
                                $produit->setAttribute('updated_by', $user->id);
                                $produit->setAttribute('updated_at', new \DateTime());
                                $produit->update();
                            }

                        }

                    }

                }
            }
        }

        return redirect()->route('entree.index')->with('succes', 'Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreesProduits  $entreesProduits
     * @return \Illuminate\Http\Response
     */
    public function show(EntreesProduits $entreesProduits, $id)
    {
        //afficher les details entree

        $details = DetailsEntrees::where('entrees_id', $id)->get();
        return view('entree/details', compact('details'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntreesProduits  $entreesProduits
     * @return \Illuminate\Http\Response
     */
    public function edit(EntreesProduits $entreesProduits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntreesProduits  $entreesProduits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntreesProduits $entreesProduits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntreesProduits  $entreesProduits
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntreesProduits $entreesProduits)
    {
        //
    }

    public function trie(){
        return view('entree.triexport');
    }

    public function exportpdf(Request $request){
        $entrees = EntreesProduits::select('entrees_produits.*')
            ->whereDate('created_at','>=',$request->date_debut)
            ->whereDate('created_at','<=',$request->date_fin)
            ->orderBy('created_at','asc')
            ->get();
//dd($entrees);
        $pdf = PDF::loadView('entree/export', compact('entrees'));
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


         $name = "export-entree"."-". $date .".pdf";
         return $pdf->download($name);
    }
}
