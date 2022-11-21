<?php

namespace App\Http\Controllers;

use App\Models\DetailsEntrees;
use App\Models\DetailsSorties;
use App\Models\EntreesProduits;
use App\Models\Produits;
use App\Models\RestesProduits;
use App\Models\SortiesProduits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class SortiesProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //renvoie sur la liste des sorties de produits
        $sorties = SortiesProduits::orderBy('id', 'desc')->get();
        return view('sortie/index',compact('sorties'));
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
            $entrees = EntreesProduits::orderBy("id","asc")->get();
            return view('sortie/create', compact('produits','entrees'));
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

                     $name_image = 'sortie'.date('Ymd-His').'-'.$request->date_sortie. '.' .$images->extension();
                     $images->move(public_path('storage'), $name_image); /* vérifie si le document de dépot existe sinon ça crée ça*/

                    //  echo "Upload Successfully";
                }

        }
        $sorties = new SortiesProduits();
        $sorties->setAttribute('demandeur', $request->demandeur);
        $sorties->setAttribute('secteur', $request->secteur);
        $sorties->setAttribute('date_sortie', $request->date_sortie);
        $sorties->setAttribute('path_bordereau', $name_image);
        $sorties->setAttribute('created_by', $user->id);
        $sorties->setAttribute('created_at', new \DateTime());
        $sorties->save();

        if($sorties){

            if (!empty($request->articles_id)){

                $tab_quantite = $request->quantite;
                $tab_observation = $request->observation;
                $tab_reference = $request->reference;
                $articles_id = $request->articles_id;

                foreach ($articles_id as $key => $value) {

                    if(!empty ($value) && !empty ($tab_quantite[$key]) ){
                        // recupérer le prix de l'article à partir de sa fréférence dans la table entrée
                        $details = DetailsEntrees::where('reference', $tab_reference[$key])
                                                     ->where('articles_id',$value)
                                                     ->first();
                        //on recupère le pri unitaire du produit lié à cette référence
                        $prix_unitaire_entree =  $details->prix_unitaire;
                        //calculer le prix total de sortie
                        $prix_total = $tab_quantite[$key] * $prix_unitaire_entree;
                        $details = new DetailsSorties();
                        $details->setAttribute('articles_id', $value);
                        $details->setAttribute('quantite', $tab_quantite[$key]);
                        $details->setAttribute('reference', $tab_reference[$key]);
                        $details->setAttribute('prix_unitaire', $prix_unitaire_entree);
                        $details->setAttribute('prix_total', $prix_total);
                        $details->setAttribute('observation', $tab_observation[$key]);
                        $details->setAttribute('sorties_id', $sorties->id);
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
                                $quantite = $oldquantite - $newquantite;

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

        return redirect()->route('sortie.index')->with('succes', 'Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SortiesProduits  $sortiesProduits
     * @return \Illuminate\Http\Response
     */
    public function show(SortiesProduits $sortiesProduits, $id)
    {
        //renvoie sur les détails d'une sortie de produit
        $details = DetailsSorties::where('sorties_id', $id)->get();
        return view('sortie/details', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SortiesProduits  $sortiesProduits
     * @return \Illuminate\Http\Response
     */
    public function edit(SortiesProduits $sortiesProduits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SortiesProduits  $sortiesProduits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SortiesProduits $sortiesProduits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SortiesProduits  $sortiesProduits
     * @return \Illuminate\Http\Response
     */
    public function destroy(SortiesProduits $sortiesProduits)
    {
        //
    }

    public function trie(){
        return view('sortie.triexport');
    }

    public function exportpdf(Request $request){
        $sorties = SortiesProduits::select('sorties_produits.*')
            ->whereDate('created_at','>=',$request->date_debut)
            ->whereDate('created_at','<=',$request->date_fin)
            ->orderBy('created_at','asc')
            ->get();
//dd($sorties);
        $pdf = PDF::loadView('sortie/export', compact('sorties'));
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


         $name = "export-sortie"."-". $date .".pdf";
         return $pdf->download($name);
    }
}
