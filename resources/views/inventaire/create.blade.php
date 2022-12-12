@extends('include.layout')
@section('title') Sysges Don Bosco - Inventaire @endsection
@section('contenu')
<div class="card">
    <div class="table-responsive">

    <div class="card-body">
        <h5 class="card-title"> Fiche Inventaire</h5>
        <form class="row g-3" method="POST" action="{{route('inventaire.store')}}"  enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Concerné(e)</label>
              <select id="inputState" class="form-select" name="inventories_id">
                <option selected>Choisir...</option>
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
            </div>
        <!-- Small tables -->
        <table class="table table-striped table-hover table-bordered data-tables">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Produit</th>
              <th scope="col">Quantité restante</th>
              <th scope="col">Quantité repertorié</th>
              <th scope="col">observation</th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i=1;
              @endphp
              @foreach ($inventaires as $inventaire )
              <tr>
              <th scope="row">{{$i++}}</th>
              <td>
                <select id="inputState" class="form-select" name="articles_id[]">
                    <option value="{{$inventaire->getProduit->id}}" selected>{{$inventaire->getProduit->libelle}}</option>
                </select>
              </td>
              <td>
                <input type="text" class="form-control" id="inputAddress2" value="{{$inventaire->quantite}}" name="quantite_reste[]" readonly>
              </td>
              <td>
                <input type="text" class="form-control" id="inputAddress2" value="" name="quantite_inventorie[]" required>
              </td>
              <td>
                <textarea class="form-control" placeholder="observation" id="floatingTextarea" style="height: 100px;" name="observation[]"></textarea>
              </td>
          </tr>
              @endforeach
          </tbody>
        </table>
        <!-- End small tables -->
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
          </div>
        </form><!-- End Multi Columns Form -->

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
