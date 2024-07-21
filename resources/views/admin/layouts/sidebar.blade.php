  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">

      <span class="brand-text font-weight-light">Moraspirit</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('dashboard') }}" class="nav-link {{ $nav=='dashboard'?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>
          <li class="nav-item ">
            <a href="{{ route('index.events') }}" class="nav-link {{ $nav=='events'?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Events
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('get.tournaments') }}" class="nav-link {{ $nav=='tournaments'?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tournaments
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('get.sports') }}" class="nav-link {{ $nav=='sports'?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Sports
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('get.universities') }}" class="nav-link {{ $nav=='universities'?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Universities
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('get.categories') }}" class="nav-link {{ $nav=='categories'?'active':'' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
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
