@extends('include.layout')
@section('title') Sysges Don Bosco - Liste utilisateurs @endsection
@section('contenu')
<div class="card">
    <div class="table-responsive">
        @php
        $user_role = Auth::user()->roles_id ;
        @endphp
    <div class="card-body">
        <h5 class="card-title">Liste des utilisateurs</h5>

        <!-- Small tables -->
        <table class="table table-striped table-hover table-bordered data-tables">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom et Prénom</th>
              <th scope="col">Email</th>
              <th scope="col">Roles</th>
              <th scope="col">Date de Création</th>
              @if($user_role == "1")
              <th scope="col">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($users as $user )
              <tr>
              <th scope="row">{{$i++}}</th>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->getRole->libelle}}</td>
              <td>{{$user->created_at}}</td>
              @if($user_role == "1")
              <td class="text-center"><a href="{{route('user.edit', $user->id)}}"><i class="bi bi-pencil-square text-danger"></i></a></td>
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
