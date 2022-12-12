@extends('include.layout')
@section('title') Sysges Don Bosco - Liste Inventaire @endsection
@section('contenu')
<div class="card">
    <div class="table-responsive">

    <div class="card-body">
        <h5 class="card-title">Liste des inventaires</h5>

        <!-- Small tables -->
        <table class="table table-striped table-hover table-bordered data-tables">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date inventaire</th>
              <th scope="col">Faire par</th>
              <th scope="col">Gestionnaire de Stock</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($inventaires as $inventaire )
              <tr>
              <th scope="row">{{$i++}}</th>
              <td>{{$inventaire->created_at}}</td>
              <td>{{$inventaire->getUserCreated->name}}</td>
              <td>{{$inventaire->getInventorie->name}}</td>
              <td class="text-center"><a href="{{route('inventaire.show', $inventaire->id)}}"><i class="bi bi-eye text-danger"></i></a></td>
          </tr>

              @endforeach
          </tbody>
        </table>
        <!-- End small tables -->

      </div>
    </div>
  </div>
@endsection
