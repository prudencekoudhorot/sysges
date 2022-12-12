@extends('include.layout')
@section('title') Sysges Don Bosco - User @endsection
@section('contenu')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Enregistrer un utilisateur</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" method="POST" action="{{route('user.update', $user->id)}}"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Nom et Prénoms</label>
          <input type="text" value="{{$user->name}}" class="form-control" name="name" id="inputName5" required>
        </div>
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Rôle</label>
          <select class="form-select" id="floatingSelect" aria-label="State" name="roles_id" required>
            <optgroup label="valeur par défaut">
                <option value="{{$user->roles_id}}">{{$user->getRole->libelle}}</option>
            </optgroup>
            <optgroup label="Choisir">
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->libelle}}</option>
                @endforeach
            </optgroup>
          </select>
        </div>
        <div class="col-md-6">
          <label for="inputName5" class="form-label">E-mail</label>
          <input type="email" class="form-control" name="email" id="inputName5"  value="{{$user->email}}" required>
        </div>
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" name="password" id="inputName5">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" required>
            <label class="form-check-label" for="gridCheck">
              Confirmer les informations rentrées
            </label>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
          <button type="reset" class="btn btn-secondary">Réinitialiser</button>
        </div>
      </form><!-- End Multi Columns Form -->

    </div>
  </div>
  @endsection
  @section('jsScript')
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  @endsection
