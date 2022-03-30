<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-olive elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-teal">
      <img src="img/AdminLTELogo.png"
           alt="Admin Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Mada BazarMAIVA </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Tableau de bord</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Membres
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="allMembers.php" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Tous les Membres</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="members.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Membres Particuliers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="proMembers.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Membres Professionnels</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas  fa-suitcase nav-icon"></i>
              <p>
                Annonces
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="allAdvs.php" class="nav-link">
                  <i class="fas fa-copy nav-icon"></i>
                  <p>Toutes les Annonces</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="premiumAdv.php" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Annonces Premium</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="topAdv.php" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Annonces en Tete</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="urgentAdv.php" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Annonces Urgentes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="favoriteAdv.php" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Annonces Favorites</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="categorie.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>Catégories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="region.php" class="nav-link">
              <i class="nav-icon fas fa-map-pin"></i>
              <p>Région</p>
            </a>
          </li>
          <li class="nav-header">AUTRES</li>
          <li class="nav-item">
            <a href="docs.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>