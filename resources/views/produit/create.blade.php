@extends('include.layout')
@section('title') Sysges Don Bosco - Créer produit @endsection
@section('contenu')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Créer un produit</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" method="POST" action="{{route('produit.store')}}">
        @csrf
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Libellé</label>
          <input type="text" class="form-control" name="libelle" id="inputName5" required>
        </div>
        <div class="col-md-6">
          <label for="inputEmail5" class="form-label">Unité de mesure</label>
          <input type="text" class="form-control" name="unite_mesure" id="inputEmail5" required>
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
