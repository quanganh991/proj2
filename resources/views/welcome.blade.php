<!doctype html>
<html lang="en">

<head>
    <title>BookShop</title>
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ URL::to('/') }}/public/frontend/img/rsz_5logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/owl.carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/owl.carousel/assets/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/style.default.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{asset('public/frontend/custom.css')}}">
</head>

<body>
<div id="all">
    <?php
    $lastStatistic = DB::table('statistic')->get()->last();
    DB::table('statistic')->where('id_statistic',$lastStatistic->id_statistic)->update(['access_quantity'=>($lastStatistic->access_quantity + 1)]);
    ?>
    <div style="background: #ffc99c">
        <div class="container">
            <div class="row d-flex align-items-center">

                <div class="col-md-4">
                    <form method="GET" action="{{URL::to('/search-result')}}">

                        <input type="text" name="keyword" id="keyword" placeholder="Bạn muốn tìm gì ?"/>
                        <button type="submit">Tìm kiếm</button>
                    </form>
                </div>


                <div class="col-md-4 d-md-block d-none">
                    <form method="GET" action="{{URL::to('/user-view-notification')}}">
                        @if(Session::get('notification'))
                        <input style="color: red" type="text" readonly value="Bạn có {{Session::get('notification')}} thông báo mới"/>
                        <input type="submit" value="Xem"/>
                        @endif
                    </form>
                </div>


                <div class="col-md-4">
                    <div class="d-flex justify-content-md-end justify-content-between">

                        <ul class="list-inline contact-info d-block d-md-none">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                        @if(Session::get('login') == false)
                            <div class="login">
                                <a href="{{URL::to('/login')}}" class="login-btn">
                                    <i class="fa fa-sign-in"></i>
                                    <span class="d-none d-md-inline-block">Đăng nhập</span>
                                </a>
                                <a href="{{URL::to('/signup')}}" class="signup-btn">
                                    <i class="fa fa-user"></i>
                                    <span class="d-none d-md-inline-block">Đăng ký</span>
                                </a>
                            </div>
                        @elseif(Session::get('id_admin'))
                            <div class="login">
                                <?php
                                $nameAdmin = DB::table('admininfo')
                                    ->select('name')
                                    ->where('id_admin', Session::get('id_admin'))
                                    ->get()->first();
                                ?>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="color: red">
                                    {{$nameAdmin->name}} - Admin
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng xuất</a>
                                    <a class="dropdown-item" href="{{URL::to('/change-information')}}">Thông tin cá
                                        nhân</a>
                                </div>
                            </div>


                        @elseif(Session::get('id_customer'))
                            <div class="login">
                                <?php
                                $nameCustomer = DB::table('customer')
                                    ->select('name')
                                    ->where('id_customer', Session::get('id_customer'))
                                    ->get()->first();
                                ?>

                            </div>
                            <div class="log out">
                                <div class="dropdown">
                                    @endif

                                    <button type="button" class="btn btn-default btn-sm">
                                        <a href="{{URL::to('/show-cart')}}"><span
                                                class="glyphicon glyphicon-shopping-cart"></span>Giỏ hàng</a>
                                    </button>
                                    @if(Session::get('id_customer'))
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="color: green">
                                        Xin chào: {{$nameCustomer->name}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{URL::to('/logout')}}">Đăng xuất</a>
                                        <a class="dropdown-item" href="{{URL::to('/change-information')}}">Thông tin cá
                                            nhân</a>
                                        <a class="dropdown-item" href="{{URL::to('/user-view-order')}}">Các đơn hàng</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <ul class="social-custom list-inline">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/home') }}">Trang chủ</a>
        @else
            <a href="{{ route('login') }}">Đăng nhập</a>
        @endauth
    @endif
    <header class=" make-sticky sticky">
        <div style="background: yellow" id="navbar" role="navigation" class="navbar navbar-expand-lg">
            <div class="container">
                <a href="{{URL::to('/home')}}" class="navbar-brand home"><img width="164" height="164"
                                                                              src="{{ URL::to('/') }}/public/frontend/img/rsz_5logo.jpg"
                                                                              alt="Alease logo"
                                                                              class="d-none d-md-inline-block">
                    <img width="130" height="130" src="{{ URL::to('/') }}/public/frontend/img/rsz_11logo.jpg"
                         alt="Alease logo" class="d-inline-block d-md-none">
                    <span class="sr-only">Về trang chủ BookShop</span>
                </a>
                <button type="button" data-toggle="collapse" data-target="#navigation"
                        class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i
                        class="fa fa-align-justify"></i></button>
                <div id="navigation" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav ml-auto">
                        <!-- ==========Home ===============-->
                        <li class="nav-item dropdown active"><a href="javascript: void(0)" data-toggle="dropdown"
                                                                class="dropdown-toggle">BookShop<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a
                                        href="{{URL::to('/list-news-for-user')}}"
                                        class="nav-link">Tin tức</a></li>
                                <li class="dropdown-item"><a href="{{URL::to('/home')}}" class="nav-link">Trang chủ</a>
                                </li>
                                <?php
                                $AllCategoryMain = DB::table('category_main') //thanh category to đùng
                                ->get();
                                foreach ($AllCategoryMain as $EachOfAllCategoryMain) {
                                ?>
                                <li class="dropdown-item"><a
                                        href="{{URL::to('/branch-result/'.$EachOfAllCategoryMain->id_category_main)}}"
                                        class="nav-link">{{$EachOfAllCategoryMain->name}}</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        @foreach($AllCategoryMain as $EachOfAllCategoryMain)
                            <li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown"
                                                             class="dropdown-toggle">{{$EachOfAllCategoryMain->name}}<b
                                        class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <?php
                                $AllCategoryBranch = DB::table('category_branch')
                                    ->where('id_category_main', $EachOfAllCategoryMain->id_category_main)
                                    ->get();
                                ?>
                                    <li class="dropdown-item"><a style="color: red"
                                            href="{{URL::to('/branch-result/'.$EachOfAllCategoryMain->id_category_main)}}"
                                            class="nav-link">{{$EachOfAllCategoryMain->name}}</a></li>
                                @foreach($AllCategoryBranch as $EachOfAllCategoryBranch)
                                    <li class="dropdown-item"><a
                                            href="{{URL::to('/product-result/'.$EachOfAllCategoryBranch->id_category_branch)}}"
                                            class="nav-link">{{$EachOfAllCategoryBranch->name}}</a></li>
                                @endforeach
                            </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div id="search" class="collapse clearfix">
                    <form role="search" class="navbar-form">
                        <div class="input-group">
                            <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                  <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!-- Navbar End-->
@yield('login')
@yield('signup')
@yield('content')
@yield('category_main')
@yield('category_branch')
@yield('product')
@yield('product_detail')
@yield('cart')
@yield('noteDetail')
@yield('savePayment')
@yield('order')
@yield('lease')
<!-- FOOTER -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-5">
                    <h4 class="h6">Về BookShop</h4>
                    <p>Để phản ánh chất lượng dịch vụ, vui lòng liên hệ với chúng tôi theo số điện thoại 0911561830</p>
                    <hr>
                    Hoặc địa chỉ email bookshop@Gmail.com
                    <hr class="d-block d-lg-none">
                        <?php
                        $prov = DB::table('province')->get();
                        ?>
                        <form method="GET" action="{{URL::to('/locate')}}">
                            <div class="input-group col-5">
                                <select class="form-control" name="id_province" id="id_province">
                                    @foreach($prov as $indexprov)
                                        <option
                                            value="{{$indexprov->id_province}}">{{$indexprov->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-secondary"><i class="fa fa-send"></i></button>
                            </div>
                        </form>
                        @if(Session::get('idprovince') == true)
                            <p style="color: yellow">Bạn đang ở: {{DB::table('province')->where('id_province',Session::get('idprovince'))->get()->first()->name}}</p>
                        @else <p style="color: yellow">Bạn ở tỉnh thành nào</p>
                        @endif
                </div>
                <div class="col-lg-3">
                    <h4 class="h6">Blog</h4>
                    <ul class="list-unstyled footer-blog-list">
                        <li class="d-flex align-items-center">
                            <div class="image"><img width="130" height="130"
                                                    src="{{ URL::to('/') }}/public/frontend/img/rsz_5logo.jpg" alt="..."
                                                    class="img-fluid"></div>
                            <div class="text">
                                <h5 class="mb-0">BookShop</h5>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="image"><img width="130" height="130"
                                                    src="{{ URL::to('/') }}/public/frontend/img/rsz_5logo.jpg" alt="..."
                                                    class="img-fluid"></div>
                            <div class="text">
                                <h5 class="mb-0">Nhà phân phối sách hàng đầu Việt Nam</h5>
                            </div>
                        </li>
                    </ul>
                    <hr class="d-block d-lg-none">
                </div>
                <div class="col-lg-3">
                    <h4 class="h6">Liên hệ</h4>
                    <p class="text-uppercase"><strong>MyBookShop Ltd.</strong><br>1 Dai Co Viet <br>Hai Ba Trung <br>Ha
                        Noi <br>VietNamese <br><strong>VietNam</strong></p>
                    @if(Session::get('id_admin'))
                        <a href="{{URL::to('/welcome-admin')}}" class="btn btn-template-main">Đến trang dành cho
                            Admin</a>
                    @endif
                    <hr class="d-block d-lg-none">
                </div>

            </div>
        </div>
        <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 text-center-md">
                        <p>&copy; 2020. Bookshop</p>
                    </div>
                    <div class="col-lg-8 text-right text-center-md">
                        <!-- Please do not remove the backlink to us unless you purchase the Attribution-free License at https://bootstrapious.com/donate. Thank you. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/popper.js/umd/popper.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
<script src="{{asset('public/frontend/vendor/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.parallax-1.1.3.js')}}"></script>
<script src="{{asset('public/frontend/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('public/frontend/vendor/jquery.scrollto/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('public/frontend/js/front.js')}}"></script>

</body>

</html>
