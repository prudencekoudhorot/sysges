@extends('include.layout')
@section('title') Sysges Don Bosco - Liste produit @endsection
@section('contenu')
<div class="card">
        @php
        $user_role = Auth::user()->roles_id ;
        @endphp
    <div class="table-responsive">

    <div class="card-body">
        <h5 class="card-title">Liste des produits préenregistré</h5>

        <!-- Small tables -->
        <table class="table table-striped table-hover table-bordered data-tables">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Libelle</th>
              <th scope="col">Unité de mesure</th>
              <th scope="col">Auteur</th>
              <th scope="col">Modifier par</th>
              <th scope="col">Date de Création</th>
              <th scope="col">Date de modification</th>
              @if(($user_role == "1") OR ($user_role == "2"))
              <th scope="col">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($produits as $produit )
              <tr>
              <th scope="row">{{$i++}}</th>
              <td>{{$produit->libelle}}</td>
              <td>{{$produit->unite_mesure}}</td>
              <td>{{$produit->getUserCreated->name}}</td>
              @if(empty($produit->updated_by))
              <td>Néant</td>
              @else
              <td>{{$produit->getUserUpdated->name}}</td>
              @endif
              <td>{{$produit->created_at}}</td>
              @if(empty($produit->updated_at))
              <td>Néant</td>
              @else
              <td>{{$produit->updated_at}}</td>
              @endif
            @if(($user_role == "1") OR ($user_role == "2"))
              <td class="text-center"><a href="{{route('produit.edit', $produit->id)}}"><i class="bi bi-pencil-square text-danger"></i></a></td>
            @endif
          </tr>
              @endforeach
          </tbody>
        </table>
        <!-- End small tables -->

      </div>
    </div>
  </div>
@endsection
@section('jsScript')
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
@endsection
