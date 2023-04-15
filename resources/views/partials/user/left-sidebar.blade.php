  @php
  $current_route=request()->route()->getName();
  @endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin-assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">User's Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset("storage/images/".Auth::user()->profile_image) }}" class="img-circle elevation-2" style="width: 40px; height: 40px;"
          alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::current()->getName() == "home" ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        {{-- {{ Route::current()->getName() }} --}}
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shops.userShop') }}" class="nav-link {{ Route::current()->getName() == "shops.userShop" ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        {{-- {{ Route::current()->getName() }} --}}
                        <p>Shops</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bookingList.index') }}" class="nav-link {{ Route::current()->getName() == "bookingList.index" ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      {{-- {{ Route::current()->getName() }} --}}
                      <p>Bookings</p>
                  </a>
              </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>