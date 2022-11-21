@extends('include.layout')
@section('title') Sysges Don Bosco - Exporter inventaires en pdf @endsection
@section('contenu')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Exporter les inventaires en PDF</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" method="POST" action="{{route('inventaire.export')}}"  enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Date début</label>
          <input type="date" class="form-control" name="date_debut" id="inputName5" required>
        </div>
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Date fin</label>
          <input type="date" class="form-control" name="date_fin" id="inputName5" required>
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
          <button type="submit" class="btn btn-primary">Exporter</button>
          <button type="reset" class="btn btn-secondary">Réinitialiser</button>
        </div>
      </form><!-- End Multi Columns Form -->

    </div>
  </div>
  @endsection

