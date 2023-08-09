<!DOCTYPE HTML>
<html>

<head>

  <!-- Basic Page Needs
	================================================== -->


  <title>Sorties</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <!-- Script
        ==============-->

  <!-- CSS
	================================================== -->

  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      line-height: 1.5;

    }

    header {
      position: fixed;
      top: 0cm;
      left: 0cm;
      right: 0cm;
      height: 3.5cm;
    }

    @page {
      size: 21cm 29.7cm;
      margin-left: 1.8cm;
      margin-right: 1.7cm;
      margin-top: 1.5cm;
      margin-bottom: 1.5cm;
    }

    /* Define the footer rules*/
    footer {
      position: fixed;
      display: block;
      bottom: 0cm;
      left: 0cm;
      right: 0cm;
      min-height: 2.5cm;
      width: 100%;
      font-family: Arial, sans-serif;
      font-size: 8pt;
    }

    .nav {
      padding: 0;
      display: block;
      margin: 0;
    }

    .nav .nav-left {
      float: left;
      text-align: center;
      max-width: 30%;
      padding: 5px 10px 5px 0;
    }

    .nav .nav-right {
      text-align: center;
      left: 30%;
      font-size: 90%;
      line-height: 1.1;
    }

    .nav .nav-left1 {
      float: left;
      text-align: center;
      width: 65%;
      padding: 5px 10px 5px 0;
      font-size: 90%;
      line-height: 1.1;
    }

    .nav .nav-right1 {

      text-align: center;
      left: 35%;
      font-size: 90%;
      line-height: 1.1;
    }

    .contenu {
      clear: both;
      display: block;
      margin: 10px 0 0 0;
      width: 100%;
      padding: 10px 0 0 0;
      left: 0;
    }

    .bloc-titre {
      clear: both;
      display: block;
      background-color: #eff5ef;
      padding: 5px 10px;
      margin: 5px 0;
      font-size: 110%;
      font-weight: bold;
      text-transform: uppercase;
    }

    .bloc-texte {
      display: block;
      padding: 5px;
      margin: 0;
      line-height: 1.6;
    }

    .bloc-texte .image {
      float: right;
      top: 0;
      text-align: center;
      max-width: 30%;
      padding: 0;
      margin: 0;
    }

    .bloc-texte .qrcode {
      float: left;
      top: 0;
      text-align: center;
      width: 35%;
      padding: 0;
      margin: 2px;
      border-right: 1px solid #cacaca;
    }

    .bloc-texte .qrtexte {
      top: 0;
      text-align: left;
      margin: 2px 2px 2px 40%;
      padding: 0;
      padding-bottom: 10px;
    }

    .bloc-texte .doc {
      text-align: center;
      max-width: 30%;
      padding: 5px;
      margin: 0 1% 20px 0;
      border: 1px solid #aaa;
    }

    h3,
    h4 {
      font-weight: bold;
      text-transform: uppercase;
      margin: 5px;

    }

    h3 {
      font-size: 125%;
      margin-bottom: 10px;
    }

    h4 {
      font-size: 110%;
      margin-top: 5px;
    }


    table {
      border-collapse: collapse;
      width: 100%;
      margin: 5px 0 0 0;
      padding: 0;
      left: 0;

    }

    td,
    th {
      border: 0.4px solid #767373;
      text-align: left;
      padding: 4px 8px;
    }

    tr:nth-child(even) {
      background-color: #f0f3f4;
    }

    .pagenum:before {
      content: counter(page);
    }
  </style>


</head>

<body>
  <div class="nav">
    <div class="nav-left" style="text-align: left;padding:0 10px; margin-top:-20px;">
      <img src="assets/img/favicon.png" alt="" height="90px">
    </div>
    <div class="nav-right" style="text-align: right;padding:0 10px; line-height:1.2; ">
      <span style="font-size: 170%;"><b>Foyer Don Bosco</b></span><br>
      Tokpota Carder , Porto-Novo, Benin<br> Tél. : +229 97 56 53 76<br>
    </div>
    <div style="border-top: 0.5px solid #3069a9; border-bottom:0.5px solid black; padding: 1px 0; margin: 35px 0; height: 1px;">
      &nbsp;</div>
  </div>
  @foreach ($sorties as $sortie)

  <div class="contenu" style="clear:both; display:block; ">
    <span style="font-size: 110%;"><u>Sortie du </u> : <b>{{$sortie->created_at}}</b></span><br>
    <span style="font-size: 110%;"><u>Demandeur </u> : <b>{{$sortie->demandeur}}</b></span><br>
    <span style="font-size: 110%;"><u>Secteur </u> : <b>{{$sortie->secteur}}</b></span><br>
    <span style="font-size: 110%;"><u>Faire par </u> : <b>{{$sortie->getUserCreated->name}}</b></span><br><br>
    @php
        $details = App\Models\DetailsSorties::where('sorties_id', $sortie->id)->get();
    @endphp
    <table style="width:100%;">
        <thead style="background-color:#bcd7f0;">
          <tr>
            <th style="width: 3%;">#</th>
            <th style="width:40%;">Désignation</th>
            <th style="text-align: center; max-width: 5%;">Qté</th>
            <th style="text-align: center; max-width: 10%;">P.U</th>
            <th style="text-align: center; max-width: 10%;">P.T</th>
            <th style="text-align: center; max-width: 10%;">Référence entrée</th>
            <th style="text-align: center; max-width: 17%;;">Observation</th>
          </tr>
        </thead>
        <tbody>
        @php $i=0 @endphp
        @foreach ($details as $detail)
            <tr>
            <td style="text-align: center;vertical-align:top;">{{ ++$i }}</td>
            <td style="vertical-align:top;">
              <b>{{$detail->getProduit->libelle}}</b>
            </td>
            <td style="text-align: right;">{{$detail->quantite}}</td>
            <td style="text-align: right;">{{$detail->prix_unitaire}}</td>
            <td style="text-align: right;">{{$detail->prix_total}}</td>
            <td style="text-align: right;">{{$detail->reference}}</td>
            <td style="text-align: right;">{{$detail->observation}}</td>
            </tr>
          @endforeach
          @php
          $prix_unitaire = DB::table('details_sorties')->where('sorties_id', $sortie->id)->sum('details_sorties.prix_unitaire');
          $prix_total = DB::table('details_sorties')->where('sorties_id', $sortie->id)->sum('details_sorties.prix_total');
          @endphp
          <tr>
            <td colspan="4" style="text-align: center;">Total</td>
            <td colspan="3"  style="text-align: right;">{{$prix_total}}</td>
          </tr>
        </tbody>
      </table>
  </div>
  @endforeach
</body>

</html>
