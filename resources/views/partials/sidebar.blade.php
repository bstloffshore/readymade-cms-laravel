<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('public/cms.png') }} " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('public/vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item {{ request()->is('admin/dashboard') ? 'menu-open' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Inbox
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">3</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/layout/top-nav.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Leads</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lead Sliders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/layout/boxed.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Contact Page Leads</p>
                    </a>
                  </li>
                  </li>
                </ul>
              </li>
              <li class="nav-item {{ request()->is('admin/roles*') || request()->is('admin/module-settings') || request()->is('admin/users') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    User Settings
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">3</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }} ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User Group & Role</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('module-settings.index') }}" class="nav-link {{ request()->is('admin/module-settings') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Module Settings</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage CMS Users</p>
                    </a>
                  </li>
                  </li>

                </ul>
              </li>
              <li class="nav-item  {{ request()->is('admin/countries*')  ? 'menu-open' : '' }} ">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Location Settings
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">2</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('countries.index') }}" class="nav-link {{ request()->is('admin/countries') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Country</p>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Administrative Regions</p>
                    </a>
                  </li> --}}
                  </li>

                </ul>
              </li>

          <li class="nav-item {{ request()->is('admin/menus*') || request()->is('admin/sliders*') || request()->is('admin/office-locations*') || request()->is('admin/galleries*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Website Settings
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('menus.index') }}" class="nav-link {{ request()->is('admin/menus') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sliders.index') }}" class="nav-link {{ request()->is('admin/sliders') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homepage Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('office-locations.create') }}" class="nav-link {{ request()->is('admin/office-locations*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Office Location Address</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blogs Page</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a href="{{ route('galleries.index') }}" class="nav-link {{ request()->is('admin/galleries*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery</p>
                </a>
              </li>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('admin/site-settings*') || request()->is('admin/general-sections*') || request()->is('admin/seo*')  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Gneral Settings
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('site-settings.create') }}" class="nav-link {{ request()->is('admin/site-settings*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('general-sections.index') }}" class="nav-link {{ request()->is('admin/general-sections*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gneral Section</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('seo.index') }}" class="nav-link {{ request()->is('admin/seo*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO</p>
                </a>
              </li>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
