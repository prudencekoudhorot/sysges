@extends('include.layout')
@section('title') Sysges Don Bosco - Liste produit @endsection
@section('contenu')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Liste des produits préenregistré</h5>

      <!-- Small tables -->
      <table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Désignation</th>
            <th scope="col">Quantité livrée</th>
            <th scope="col">Prix unitaire (f cfa)</th>
            <th scope="col">Prix total (f cfa)</th>
            <th scope="col">Observation</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach ($details as $detail )
            <tr>
            <th scope="row">{{$i++}}</th>
            <td>{{$detail->getProduit->libelle}}</td>
            <td>{{$detail->quantite}} {{$detail->getProduit->unite_mesure}}</td>
            <td>{{$detail->prix_unitaire}}</td>
            <td>{{$detail->prix_total}}</td>
            <td>{{$detail->observation}}</td>
        </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End small tables -->

    </div>
  </div>
@endsection
