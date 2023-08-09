@extends('include.layout')
@section('title') Syges Don Bosco - Accueil @endsection
@section('contenu')
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
          <li class="breadcrumb-item active">Reste produits</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reste produit &nbsp; &nbsp; <a href="{{route('reste.export')}}" class="btn btn-success">PDF</a></h5>

              <!-- Small tables -->
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Désignation</th>
                    <th scope="col">Stock théorique restant</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($restes as $reste )
                    <tr>
                    @php
                        $quantite = $reste->quantite;
                    @endphp
                    @if($quantite <= 10)
                    <th class="bg-warning" scope="row">{{$i++}}</th>
                    <td class="bg-warning">{{$reste->getProduit->libelle}}</td>
                    <td class="bg-warning">{{$reste->quantite}} {{$reste->getProduit->unite_mesure}}</td>
                    @elseif($quantite <= 5)
                    <th class="bg-danger" scope="row">{{$i++}}</th>
                    <td class="bg-danger">{{$reste->getProduit->libelle}}</td>
                    <td class="bg-danger">{{$reste->quantite}} {{$reste->getProduit->unite_mesure}}</td>
                    @else
                    <th scope="row">{{$i++}}</th>
                    <td>{{$reste->getProduit->libelle}}</td>
                    <td>{{$reste->quantite}} {{$reste->getProduit->unite_mesure}}</td>
                    @endif
                </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End small tables -->

            </div>
          </div>
      </div>
    </section>
@endsection
