<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //liste des produit
        $produits = Produits::orderBy("id","desc")->get();
        return view("produit/index", compact("produits"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //renvoie sur la vue de création des produits
        $user = auth()->user();
        $user_role = $user->roles_id;
        if((Auth::check())AND(($user_role == "1")OR($user_role == "2"))){
            return view('produit/create');
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
        //enregistrer un produit
        $user = auth()->user();
        $produit = new Produits();
        $produit->setAttribute('libelle', $request->libelle);
        $produit->setAttribute('unite_mesure', $request->unite_mesure);
        $produit->setAttribute('created_by', $user->id);
        $produit->setAttribute('created_at', new \DateTime());
        $produit->save();
        return redirect()->route('produit.index')->with('success', 'Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function show(Produits $produits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function edit(Produits $produits, $id)
    {
        //modifier un produit
        $produit = Produits::find($id);
        return view('produit/edit',compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produits $produits, $id)
    {
        //modifier une ligne de produit
        $user = auth()->user();
        $produit = Produits::find($id);
        $produit->setAttribute('libelle', $request->libelle);
        $produit->setAttribute('unite_mesure', $request->unite_mesure);
        $produit->setAttribute('updated_by', $user->id);
        $produit->setAttribute('updated_at', new \DateTime());
        $produit->update();
        return redirect()->route('produit.index')->with('success', 'Modification effectué avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produits $produits)
    {
        //
    }





    public function exportpdf(Request $request){
        $produits = Produits::select('articles.*')
            ->orderBy('libelle','asc')
            ->get();
//dd($sorties);
        $pdf = PDF::loadView('produit/export', compact('produits'));
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


         $name = "export-produits"."-". $date .".pdf";
         return $pdf->download($name);
    }
}
