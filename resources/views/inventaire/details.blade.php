@extends('include.layout')
@section('title') Sysges Don Bosco - Fiche d'enventaire du stock @endsection
@section('contenu')
<div class="card">
    <div class="card-body">
        @php
            $created_at = \App\Models\Inventaires::where('id',$id)
        @endphp
      <h5 class="card-title">Liste des produits préenregistré</h5>

      <!-- Small tables -->
      <table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Désignation</th>
            <th scope="col">Stock théorique restant</th>
            <th scope="col">Stock réel en magasin</th>
            <th scope="col">Ecart</th>
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
            <td>{{$detail->quantite_reste}} {{$detail->getProduit->unite_mesure}}</td>
            <td>{{$detail->quantite_inventorie}} {{$detail->getProduit->unite_mesure}}</td>
            <td>{{$detail->ecart}} {{$detail->getProduit->unite_mesure}}</td>
            <td>
                @if(empty($detail->observation))
                   -
                   @else
                   {{$detail->observation}}
                @endif
            </td>
        </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End small tables -->

    </div>
  </div>
@endsection
