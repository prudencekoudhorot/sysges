@php
$user_role = Auth::user()->roles_id ;
@endphp
 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->
<!-- debut menu produit -->
@if(($user_role == "1") OR ($user_role == "2") OR ($user_role == "4"))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Produit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          @if (($user_role == "1") OR ($user_role == "2"))
          <li>
          <a href="{{route('produit.create')}}">
            <i class="bi bi-circle"></i><span>Créer</span>
          </a>
        </li>
          @endif
          <li>
            <a href="{{route('produit.index')}}">
              <i class="bi bi-circle"></i><span>Liste</span>
            </a>
          </li>
          <li>
            <a href="{{route('produit.export')}}">
              <i class="bi bi-circle"></i><span>Exporter en PDF</span>
            </a>
          </li>
        </ul>
      </li>
@endif
      <!-- End menu produit -->
    <!-- debut menu entrée produit -->
@if(($user_role == "1") OR ($user_role == "2") OR ($user_role == "4"))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-arrow-down"></i><span>Entrée produit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    @if (($user_role == "1") OR ($user_role == "2"))
          <li>
            <a href="{{route('entree.create')}}">
              <i class="bi bi-circle"></i><span>Créer</span>
            </a>
          </li>
    @endif
          <li>
            <a href="{{route('entree.index')}}">
              <i class="bi bi-circle"></i><span>Liste</span>
            </a>
          </li>
          <li>
            <a href="{{route('entree.trie')}}">
              <i class="bi bi-circle"></i><span>Exporter en PDF</span>
            </a>
          </li>
        </ul>
      </li>
@endif
      <!-- End menu entrée produit -->
      <!-- End debut sortie produit -->
@if(($user_role == "1") OR ($user_role == "2") OR ($user_role == "4"))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-earmark-arrow-up"></i><span>Sortie produit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    @if (($user_role == "1") OR ($user_role == "2"))
          <li>
            <a href="{{route('sortie.create')}}">
              <i class="bi bi-circle"></i><span>Créer</span>
            </a>
          </li>
    @endif
          <li>
            <a href="{{route('sortie.index')}}">
              <i class="bi bi-circle"></i><span>Liste</span>
            </a>
          </li>
          <li>
            <a href="{{route('sortie.trie')}}">
              <i class="bi bi-circle"></i><span>Exporter en PDF</span>
            </a>
          </li>
        </ul>
      </li>
@endif
@if(($user_role == "1") OR ($user_role == "3") OR ($user_role == "4"))
      <!-- End Menu sortie produit -->
      <li class="nav-heading">Zone administrateur</li>
      <!-- debut menu administration -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-file-text"></i><span>Inventaire</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @if(($user_role == "1") OR ($user_role == "3"))
            <li>
            <a href="{{route('inventaire.create')}}">
              <i class="bi bi-circle"></i><span>Créer</span>
            </a>
          </li>
        @endif
          <li>
            <a href="{{route('inventaire.index')}}">
              <i class="bi bi-circle"></i><span>Liste</span>
            </a>
          </li>
          <li>
            <a href="{{route('inventaire.trie')}}">
              <i class="bi bi-circle"></i><span>Exporter en PDF</span>
            </a>
          </li>
        </ul>
      </li>
    @if(($user_role == "1") OR ($user_role == "4"))
      <!-- End Menu administration -->
      <!-- Debut menu Paramètres -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Paramètres</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @if(($user_role == "1"))
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Active Storage</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Vider cache</span>
            </a>
          </li>
        @endif
          <li>
            <a href="{{route('user.index')}}">
              <i class="bi bi-circle"></i><span>Utilisateur</span>
            </a>
          </li>
        </ul>
      </li><!-- End Menu paramètres -->
    @endif
@endif
    </ul>

  </aside><!-- End Sidebar-->
