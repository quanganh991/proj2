<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BookShop | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('public/backend/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('public/backend/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/jqvmap/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/') }}" class="nav-link">Về Trang Mua Sắm</a>
      </li>
    </ul>
    <div style=" margin-left:70%">
      <a href="{{URL::to('/logout')}}" class="nav-link" style="text-align: right">Log out</a>
    </div>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ URL::to('/welcome-admin') }}" class="brand-link">
      <span style="text-align: center">Trang Admin của BookShop</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <?php
            $AD = DB::table('admininfo')->where('id_admin',Session::get('id_admin'))->get()->first();
            ?>
          <img src="{{asset('public/image/AdminAvatar/'.$AD->avatar)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php
                            $nameAdmin = DB::table('admininfo')
                                ->select('name')
                                ->where('id_admin',Session::get('id_admin'))
                                ->get()->first();
                            ?>
          <a href="{{ URL::to('/change-admin-information') }}" class="d-block">{{$nameAdmin->name}}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lý
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">11</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/all-branch-category')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/all-main-category')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý Main</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/all-product')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý sản phẩm</p>
                </a>
              </li>

                <li class="nav-item">
                    <a href="{{URL::to('/add-admin')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Thêm Admin</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{URL::to('/display-user')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý người dùng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/all-partner-delivery')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý đối tác giao hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/display-all-news')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý tin tức, sự kiện</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/view-order')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/view-all-session')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý phiên đăng nhập</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/access-quantity')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Thống kê lượt truy cập</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/revenue')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Thống kê doanh số bán hàng</p>
                    </a>
                </li>

            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">

    @yield('all_product')
    @yield('all_main_category')
    @yield('all_branch_category')
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="{{URL::to('/home')}}">BookShop</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="{{asset('public/backend/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('public/backend/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/backend/chart.js/Chart.min.js')}}"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="{{asset('public/backend/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/backend/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('public/backend/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{asset('public/backend/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('public/backend/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('public/backend/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/adminlte.js')}}"></script>
<script src="{{asset('public/backend/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('public/backend/dist/js/demo.js')}}"></script>

<script src="{{asset('public/backend/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
</body>
</html>

