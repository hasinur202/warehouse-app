
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
                        <a href="{{ route('warehouse.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Warehouse Setup</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('color.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Color Setup</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('measurement.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Measurement Setup</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('shipping.class') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Shipping Class Setup</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('district.setup') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>District Setup</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('delivery.charge') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Delivery Charge Setup</p>
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
                        <a href="{{ route('main.category.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Main Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sub.category.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Sub Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('child.category.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Child Category</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('brand.list') }}" class="nav-link">
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
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('product.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Product List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.add') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Add Product</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('brand.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Order Information
                    </p>
                </a>
            </li>

            {{--  <li class="nav-item">
                <a href="{{ route('brand.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Combo Packs
                    </p>
                </a>
            </li>  --}}

            <li class="nav-item">
                <a href="{{ route('coupon.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Coupons
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.list') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Manage Staffs
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="nav-icon fas fa-book-medical"></i>
                    <p>
                        Inventory
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Expense</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Income</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Website Setting
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('setup.about') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>About Us</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('setup.settings') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Website Info</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('privacy.policy') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Privacy & Policy</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('terms.conditions') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Terms & Conditions</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('how.to.buy') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>How to Buy</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('slider.list') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Slider</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Offer Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('faq.setup') }}" class="nav-link">
                            <i class="fas fa-angle-double-right nav-icon"></i>
                            <p>Faq</p>
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
