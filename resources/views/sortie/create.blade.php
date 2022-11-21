@extends('include.layout')
@section('title') Sysges Don Bosco - Sortie produit @endsection
@section('contenu')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Enregistrer une sortie</h5>

      <!-- Multi Columns Form -->
      <form class="row g-3" method="POST" action="{{route('sortie.store')}}"  enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <label for="inputName5" class="form-label">Demandeur</label>
          <input type="text" class="form-control" name="demandeur" id="inputName5" required>
        </div>
        <div class="col-md-6">
          <label for="inputEmail5" class="form-label">Secteur</label>
          <input type="text" class="form-control" name="secteur" id="inputEmail5" required>
        </div>
        <div class="col-md-6">
          <label for="inputEmail5" class="form-label">Bordereau de sortie</label>
          <input type="file" class="form-control" name="path_bordereau" id="inputEmail5" required>
        </div>
        <table id="mytable" class="table table-responsive col-md-12 table-bordered" style="width: 100%;">
<!-- entête tableau multiple -->
            <tr style="background-color: #2a73fa; color:#F5F6FA;">
                <th style="width: 40%;">Produit </th>
                <th>Quantité</th>
                <th style="width: 30%;">Référence</th>
                <th style="width: 20%;">Observation</th>
            </tr>
        </table>


        <br> <br> <br>
        <div class="col-md-6">
            <input id="btnadd" type="button" value="Ajouter" class="mr-2 ml-1 btn-success" />
            <input id="btnsupprimer" type="button" value="Supprimer" class="btn-danger" />
        </div>
<!-- End entête tableau multiple -->
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
  <script>
    $(document).ready(function() {
        var groupCount = 0;


        var rowTemplate = '<tr>' +
            '<td><select name="articles_id[]" class="form-select form-select-lg"  data-group="%group%" data-id="article"><option>choisir...</option>@foreach($produits as $produit)<option value="{{$produit->id}}">{{$produit->libelle}} || {{$produit->unite_mesure}}</option>@endforeach</select><br>\n\
        </td>' +

        '<td class="align-top"><input type="number" min="0" class="form-control" size="20" name="quantite[]" data-group="%group%" data-id="quantite" value="0" required></td>' +
        '<td><select name="reference[]" class="form-select form-select-lg"  data-group="%group%" data-id="article"><option>choisir...</option>@foreach($entrees as $entree)<option value="{{$entree->reference}}">{{$entree->reference}}</option>@endforeach</select>' +
              '<td class="align-top"><textarea class="form-control" placeholder="Description" size="20" name="observation[]" data-group="%group%" data-id="description"></textarea></td>' +
            '</tr>';

        for (var i = 0; i < 1; i++) {
            groupCount++;
            $('#mytable tr:last').after(rowTemplate.replaceAll('%group%', groupCount));
        }


        $(document).on("change paste keyup", "input[data-id='article']", function() {
            var id = $(this).val();
            var group = $(this).data('group');
            console.log('article:', id, group);
        });



        $(document).on("change paste keyup", "select[data-id='tauxaib']", function() {
            var tauxaib = $(this).val();
            var group = $(this).data('group');
            var quantite = $("input[data-id='quantite'][data-group='" + group + "']").val();
            var prix = $("input[data-id='prix'][data-group='" + group + "']").val();
            var tauxtva = $("select[data-id='tauxtva'][data-group='" + group + "']").val();
            //var prix_unitaire = tauxaib * prix;
            var prix_total = quantite * prix_unitaire;
            var total = prix_total * tauxtva;
            $("input[data-id='prix_unitaire'][data-group='" + group + "']").val(prix_unitaire);
            $("input[data-id='prix_total'][data-group='" + group + "']").val(prix_total);
            $("input[data-id='total'][data-group='" + group + "']").val(total);
            //alert(tauxaib);
        });

        $(document).on("change paste keyup", "input[data-id='quantite']", function() {
            var quantite = $(this).val();
            var group = $(this).data('group');
            var prix_unitaire = $("input[data-id='prix_unitaire'][data-group='" + group + "']").val();
            var tauxtva = $("select[data-id='tauxtva'][data-group='" + group + "']").val();
            var tauxaib = $("select[data-id='tauxaib'][data-group='" + group + "']").val();
            var prix = $("input[data-id='prix'][data-group='" + group + "']").val();
            //var prix_unitaire = tauxaib * prix;
            var prix_total = quantite * prix_unitaire;
            var total = prix_total * tauxtva;
            $("input[data-id='prix_unitaire'][data-group='" + group + "']").val(prix_unitaire);
            $("input[data-id='prix_total'][data-group='" + group + "']").val(prix_total);
            $("input[data-id='total'][data-group='" + group + "']").val(total);
        });

        $(document).on("change paste keyup", "input[data-id='prix']", function() {
            var prix = $(this).val();
            var group = $(this).data('group');
            var quantite = $("input[data-id='quantite'][data-group='" + group + "']").val();
            var tauxtva = $("select[data-id='tauxtva'][data-group='" + group + "']").val();
            var tauxaib = $("select[data-id='tauxaib'][data-group='" + group + "']").val();
            //var prix_unitaire = tauxaib * prix;
            var prix_total = quantite * prix_unitaire;
            var total = prix_total * tauxtva;
            $("input[data-id='prix_unitaire'][data-group='" + group + "']").val(prix_unitaire);
            $("input[data-id='prix_total'][data-group='" + group + "']").val(prix_total);
            $("input[data-id='total'][data-group='" + group + "']").val(total);
            //alert(tauxaib);
        });

        $(document).on("change paste keyup", "select[data-id='tauxtva']", function() {
            var tauxtva = $(this).val();
            var group = $(this).data('group');
            var quantite = $("input[data-id='quantite'][data-group='" + group + "']").val();
            var prix_unitaire = $("input[data-id='prix_unitaire'][data-group='" + group + "']").val();
            var prix = $("input[data-id='prix'][data-group='" + group + "']").val();
            var tauxaib = $("select[data-id='tauxaib'][data-group='" + group + "']").val();
            //var prix_unitaire = tauxaib * prix;
            var prix_total = quantite * prix_unitaire;
            var total = prix_total * tauxtva;
            $("input[data-id='prix_unitaire'][data-group='" + group + "']").val(prix_unitaire);
            $("input[data-id='prix_total'][data-group='" + group + "']").val(prix_total);
            $("input[data-id='total'][data-group='" + group + "']").val(total);
        });

        $("#btnadd").on('click', function() {
            groupCount++;
            $('#mytable tr:last').after(rowTemplate.replaceAll('%group%', groupCount));
        });

        $("#btnsupprimer").click(function() {
            $("#mytable").each(function() {

                if ($('tr', this).length > 0 && $('tr').length > 2) {
                    $('tr:last', this).remove();
                } else {
                    alert("Attention vous ne pouvez pas supprimé cette donnée")
                }
            });
        });

    });


    $(function() {
        bsCustomFileInput.init();
    });
</script>
  @endsection
