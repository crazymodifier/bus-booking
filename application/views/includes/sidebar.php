  <?php
  // $tour_pricing_active = strpos($_SERVER['REQUEST_URI'], 'tour-calendar-write') ? 'active' : '';

  if (strpos($_SERVER['REQUEST_URI'], 'tour-routes') || strpos($_SERVER['REQUEST_URI'], 'seo-management') || strpos($_SERVER['REQUEST_URI'], 'why-us') || strpos($_SERVER['REQUEST_URI'], 'about') || strpos($_SERVER['REQUEST_URI'], 'tour-content')) {
   $content_active = 'active';
   $content_active_menu = 'menu-open';
  }
  else
  {
    $content_active = $content_active_menu = '';
  }
  if (strpos($_SERVER['REQUEST_URI'], 'banner-images') || strpos($_SERVER['REQUEST_URI'], 'tour-images')) {
   $gallery_active = 'active';
   $gallery_active_menu = 'menu-open';
  }
  else
  {
    $gallery_active = $gallery_active_menu = '';
  }
  if (strpos($_SERVER['REQUEST_URI'], 'tour-packages') || strpos($_SERVER['REQUEST_URI'], 'tour-calendar-write')) {
    $tour_pricing_active = 'active';
  }
  else
  {
    $tour_pricing_active = '';
  }
  ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="btn border btn-xs px-2 mr-2" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="btn btn-xs btn-primary " href="<?=$_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-left mr-1 fa-xs"></i>Back</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="<?=base_url('logout')?>" class="btn btn-success btn-sm">log out <i class="fa fa-sign-out-alt ml-1 fa-xs"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link py-2">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Hop On Hop Off Barcelona</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-sm">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('dist/img/profilepic.jpeg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block fa-lg">HoHo Admin</a>
          <a href="profile" class="text-primary"><small>View Profile</small></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard" class="nav-link">
              <i class="nav-icon mx-0 fas fa-tachometer-alt  fa-fw"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tour-pricing" class="nav-link <?=$tour_pricing_active?>">
              <i class="nav-icon mx-0 fas fa-money-bill fa-fw"></i>
              <p>
                Tour Pricing
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="coupon-code" class="nav-link">
              <i class="nav-icon mx-0 fas fa-gift  fa-fw"></i>
              <p>
                Coupon Code
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer-management" class="nav-link">
              <i class="nav-icon mx-0 fas fa-users  fa-fw"></i>
              <p>
                Customer Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="booking-management" class="nav-link">
              <i class="nav-icon mx-0 fas fa-shopping-bag  fa-fw"></i>
              <p>
                Booking Management
              </p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="closeout-management" class="nav-link">
              <i class="nav-icon mx-0 fas fa-tachometer-alt  fa-fw"></i>
              <p>
                Manage Blockout/Closeout
              </p>
            </a>
          </li> -->
          
          <li class="nav-item has-treeview <?=$content_active_menu?>">
            <a href="#" class="nav-link <?=$content_active?>">
              <i class="nav-icon mx-0 fa fa-book-reader  fa-fw"></i>
              <p>
                Manage Content<i class="fas fa-angle-left right right-1"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="seo-management" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage SEO Content</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="why-us" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Why Book With Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="about" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About The City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tour-content" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour Content</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tour-routes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour Routes</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=$gallery_active_menu?>">
            <a href="#" class="nav-link <?=$gallery_active?>">
              <i class="nav-icon mx-0 fa fa-images  fa-fw"></i>
              <p>
                Image Gallery<i class="fas fa-angle-left right right-1"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="banner-images" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner Images</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tour-images" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour Images</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="similar-tours" class="nav-link">
              <i class="nav-icon mx-0 fa fa-bus-alt  fa-fw"></i>
              <p>
                Similar Tours
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="testimonials" class="nav-link">
              <i class="nav-icon mx-0 fa fa-quote-left  fa-fw"></i>
              <p>
                Add Testimonials
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper text-sm">