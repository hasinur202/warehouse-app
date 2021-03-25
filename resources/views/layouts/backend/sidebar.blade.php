
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{--  <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>  --}}

    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="/logo/logo.png" alt="AdminLTE Logo" style="width:100%;height:100%;background:#fff">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="nav-icon fas fa-border-none"></i>
                    <p>
                        Setup
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Admin Setup</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('warehouse.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Warehouse Setup</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Product Categories
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Main Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('warehouse.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Sub Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('warehouse.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Child Category</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Brands
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Website Setting
                    </p>
                </a>
            </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
