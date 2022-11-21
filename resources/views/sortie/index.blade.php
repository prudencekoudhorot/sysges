@extends('include.layout')
@section('title') Sysges Don Bosco - Liste produit sortis @endsection
@section('contenu')
<div class="card">
    <div class="table-responsive">

    <div class="card-body">
        <h5 class="card-title">Liste des produits sortis</h5>

        <!-- Small tables -->
        <table class="table table-striped table-hover table-bordered data-tables">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Auteur</th>
              <th scope="col">Demandeur</th>
              <th scope="col">Secteur</th>
              <th scope="col">Date de Création</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($sorties as $sortie )
              <tr>
              <th scope="row">{{$i++}}</th>
              <td>{{$sortie->getUserCreated->name}}</td>
              <td>{{$sortie->demandeur}}</td>
              <td>{{$sortie->secteur}}</td>
              <td>{{$sortie->created_at}}</td>
              <td class="text-center"><a href="{{route('sortie.show', $sortie->id)}}"><i class="bi bi-eye text-danger"></i></a> &nbsp; <button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$sortie->id}}"><i class="bi bi-receipt text-primary"></i></button></td>
          </tr>
          <!-- Modal -->
  <div class="modal fade" id="exampleModal_{{$sortie->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pièces jointe</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img class="img-responsive" src="{{ asset('storage/'.$sortie->path_bordereau) }}" alt="Image" style="width: 100%; height: auto;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
              @endforeach
          </tbody>
        </table>
        <!-- End small tables -->

      </div>
    </div>
  </div>
@endsection
