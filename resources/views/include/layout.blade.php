<!DOCTYPE html>
<html lang="fr">
  <!-- head -->
  @include('include.head')
  <!-- end head -->
  <body>
  <!-- header -->
  @include('include.header')
  <!-- end header -->
  <!-- flash message -->
  @include('flash-message')
  <!-- end flash message -->
  <!-- menu vertical -->
  @include('include.menu_vertical')
  <!-- menu vertical -->
  <main id="main" class="main">
  @yield('contenu')
  </main>
<!-- flash message -->
@include('include.footer')
<!-- end flash message -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script>
    $(document).ready(function() {

    var table = $('.data-tables').DataTable({
        "ordering": true,
             "language": {
                 "sProcessing": "Traitement en cours ...",
                 "sLengthMenu": "Afficher MENU lignes",
                 "sZeroRecords": "Aucun résultat trouvé",
                 "sEmptyTable": "Aucune donnée disponible",
                 "sLengthMenu": "Afficher &nbsp; MENU &nbsp;",
                 "sInfo": "START ... END/TOTAL &eacute;l&eacute;ments",
                 "sInfoEmpty": "Aucune ligne affichée",
                 "sInfoFiltered": "(Filtrer un maximum de MAX)",
                 "sInfoPostFix": "",
                 "sSearch": "Recherche",
                 "sUrl": "",
                 "sInfoThousands": ",",
                 "sLoadingRecords": "Chargement...",
                 "oPaginate": {
                     "sFirst": "Premier",
                     "sLast": "Dernier",
                     "sNext": "Suivant",
                     "sPrevious": "Précédent"
                 },
                 "oAria": {
                     "sSortAscending": ": Trier par ordre croissant",
                     "sSortDescending": ": Trier par ordre décroissant"
                 }

             },
             dom: '<"float-left"l><"float-right"f>Brti<"float-right"p>',
          //   stateSave : true,
             order : [[ 0, "asc" ]],
        processing: true,
        serverSide: false,
    });

    });
  </script>
  @yield('jsScript')
</body>

</html>
