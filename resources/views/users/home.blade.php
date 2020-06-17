@extends('welcome')
@section('content')
    <section style="background: url('public/sidebar/background.jpg') center center repeat; background-size: cover;"
             class="bar background-white relative-positioned">
        <div class="container">
            <!-- Carousel Start-->
            <div class="home-carousel">
                <div class="dark-mask mask-primary"></div>
                <div class="container">
                    <div class="homepage owl-carousel">
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <h1>Sách Hot Tháng 6/2020</h1>
                                    <p>Làm thế nào để nuôi dạy con thành công</p>
                                </div>
                                <div class="col-md-7"><img src="public/sidebar/1.JPG" alt="" class="img-fluid  ">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <h1>Sách Hot Tháng 6/2020</h1>
                                    <p>Bộ sách ngày xửa ngày xưa</p>
                                </div>
                                <div class="col-md-7"><img src="public/sidebar/2.JPG" alt="" class="img-fluid  ">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <h1>Sách Hot Tháng 6/2020</h1>
                                    <p>Hành trình trở thành cha mẹ thông thái</p>
                                </div>
                                <div class="col-md-7"><img src="public/sidebar/3.JPG" alt="" class="img-fluid  ">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <h1>Sách Hot Tháng 6/2020</h1>
                                    <p>Bộ sách Khoa học</p>
                                </div>
                                <div class="col-md-7"><img src="public/sidebar/4.JPG" alt="" class="img-fluid  ">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-5 text-right">
                                    <h1>Sách Hot Tháng 6/2020</h1>
                                    <p>Bộ sách thiếu nhi Hàn Quốc</p>
                                </div>
                                <div class="col-md-7"><img src="public/sidebar/5.JPG" alt="" class="img-fluid  ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End-->
        </div>


    </section>

    <section class="bar background-pentagon no-mb text-md-center">
        <div class="container">
            <div class="heading text-center">
                <h2 style="color: deeppink">Sách</h2>
            </div>
        </div>

    </section>


    <section class="bar background-white">
        <div class="container text-center">
            <h1 style="color: blue">Sự kiện mới nhất</h1>
            <?php
            $equalNews = DB::table('news')
                ->orderBy('publish_date', 'DESC')
                ->take(10)
                ->get();
            foreach ($equalNews as $eachOfEqualNews) {
                $sp = DB::table('product')->where('id_product' ,$eachOfEqualNews->id_product)->get()->first();
            ?>

            <h4 style="color: orangered">
                <img width="50" height="50"
                     src="{{ URL::to('/') }}/public/imgproduct/{{$sp->image}}"
                     alt="" class="img-fluid">
                <a href="{{URL::to('/detail-news-for-user/'.$eachOfEqualNews->id_news) }}">
                    {{$eachOfEqualNews->title}}
                    <label style="color: #7d1038">({{$eachOfEqualNews->publish_date}})</label>
                </a>
            </h4>
            <?php
            }
            ?>
            <h1 style="color: darkorange">Bán chạy nhất</h1>
            <div class="row portfolio text-center">
                <?php
                $equalProduct = DB::table('product')
                    ->orderBy('turnover', 'DESC')  //Số lần đã thuê giảm dần
                    ->take(10)
                    ->get();    //xem các sp được thuê nhiều nhất



                foreach ($equalProduct as $eachOfEqualProduct) {

                $categoryBranchOnly = DB::table('category_branch')->where('id_category_branch', $eachOfEqualProduct->id_category_branch)->get()->first();
                $categoryMainOnly = DB::table('category_main')->where('id_category_main', $categoryBranchOnly->id_category_main)->get()->first();


                $url = $categoryMainOnly->name . '/' . $categoryBranchOnly->name . '/';
                ?>

                <div class="col-md-3">
                    <div class="box-image">
                        <div class="image"><img
                                src="{{ URL::to('/') }}/public/imgproduct/{{$eachOfEqualProduct->image}}"
                                alt="" class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <div class="content">
                                    <div class="name">
                                        <h3>
                                            <a href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
                                               class="color-white">{{$eachOfEqualProduct->name}}</a></h3>
                                    </div>
                                    <div class="text">
                                        <p class="buttons"><a
                                                href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
                                                class="btn btn-template-outlined-white">Xem chi tiết</a>
                                            <form action="{{URL::to('/save-cart')}}" method="GET">
                                                <input type="hidden" name="quantity" value="1"/>
                                                <input name="productid_hidden" type="hidden"
                                                       value="{{$eachOfEqualProduct->id_product}}"/>
                                        <p class="bottons">
                                            <button type="submit" class="btn btn-template-outlined-white"><i
                                                    class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                            </button>
                                        </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5>{{$eachOfEqualProduct->name}}</h5>
                        <h5 style="color: red">$.{{$eachOfEqualProduct->price}}</h5>
                        <h5 style="color: orange">{{$eachOfEqualProduct->turnover}} lượt mua</h5>
                    </div>
                </div>

                <?php
                }
                ?>
            </div>

            <h1 style="color: green">Được người dùng đánh giá cao nhất</h1>
            <div class="row portfolio text-center">
                <?php
                $equalProduct = DB::table('product')
                    ->orderBy('rate', 'DESC')
                    ->take(10)
                    ->get();    //xem các sp được người dùng đánh giá cao nhất


                foreach ($equalProduct as $eachOfEqualProduct) {

                $categoryBranchOnly = DB::table('category_branch')->where('id_category_branch', $eachOfEqualProduct->id_category_branch)->get()->first();
                $categoryMainOnly = DB::table('category_main')->where('id_category_main', $categoryBranchOnly->id_category_main)->get()->first();
                $url = $categoryMainOnly->name . '/' . $categoryBranchOnly->name . '/';
                ?>

                <div class="col-md-3">
                    <div class="box-image">
                        <div class="image"><img
                                src="{{ URL::to('/') }}/public/imgproduct/{{$eachOfEqualProduct->image}}"
                                alt="" class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <div class="content">
                                    <div class="name">
                                        <h3>
                                            <a href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
                                               class="color-white">{{$eachOfEqualProduct->name}}</a></h3>
                                    </div>
                                    <div class="text">
                                        <p class="buttons"><a
                                                href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
                                                class="btn btn-template-outlined-white">Xem chi tiết</a>
                                            <form action="{{URL::to('/save-cart')}}" method="GET">
                                                <input type="hidden" name="quantity" value="1"/>
                                                <input name="productid_hidden" type="hidden"
                                                       value="{{$eachOfEqualProduct->id_product}}"/>
                                        <p class="bottons">
                                            <button type="submit" class="btn btn-template-outlined-white"><i
                                                    class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                            </button>
                                        </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5>{{$eachOfEqualProduct->name}}</h5>
                        <h5 style="color: red">$.{{$eachOfEqualProduct->price}}</h5>
                        <h5 style="color: orange">{{$eachOfEqualProduct->rate}} /10</h5>
                    </div>
                </div>

                <?php
                }
                ?>


            </div>
        </div>
    </section>
    <section class="bar background-pentagon no-mb text-md-center">
        <div class="container">
            <div class="heading text-center">
                <h2 style="color: deeppink">Văn phòng phẩm và đồ lưu niệm</h2>
            </div>
        </div>

    </section>

    <section class="bg-white bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="home-blog-post">
                        <div class="image"><img width="150" height="150"
                                                src="{{ URL::to('/') }}/public/imgbranch/50.jpg"
                                                alt="..." class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center"><a href="{{ URL::to('/branch-result/50') }}"
                                                                                                     class="btn btn-template-outlined-white"><i
                                        class="fa fa-chain"> </i> Nhiều hơn</a></div>
                        </div>
                        <div class="text">
                            <h4><a href="{{ URL::to('/branch-result/50') }}">Bút</a></h4>
                            <p class="intro"></p><a href="{{ URL::to('/branch-result/50') }}"
                                                    class="btn btn-template-outlined">Hiển thị tất cả</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="home-blog-post">
                        <div class="image"><img width="150" height="150"
                                                src="{{ URL::to('/') }}/public/imgbranch/51.jpg"
                                                alt="..." class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center"><a href="{{ URL::to('/branch-result/51') }}"
                                                                                                     class="btn btn-template-outlined-white"><i
                                        class="fa fa-chain"> </i> Nhiều hơn</a></div>
                        </div>
                        <div class="text">
                            <h4><a href="{{ URL::to('/branch-result/51') }}">Vở</a></h4>
                            <p class="intro"></p></p><a href="{{ URL::to('/branch-result/51') }}"
                                                        class="btn btn-template-outlined">Hiển thị tất cả</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="home-blog-post">
                        <div class="image"><img width="150" height="150"
                                                src="{{ URL::to('/') }}/public/imgbranch/52.jpg"
                                                alt="..." class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center"><a href="{{ URL::to('/branch-result/52') }}"
                                                                                                     class="btn btn-template-outlined-white"><i
                                        class="fa fa-chain"> </i> Nhiều hơn</a></div>
                        </div>
                        <div class="text">
                            <h4><a href="{{ URL::to('/branch-result/52') }}">Đồ dùng văn phòng</a></h4>
                            <p class="intro"></p><a href="{{ URL::to('/branch-result/52') }}"
                                                    class="btn btn-template-outlined">Hiển thị tất cả</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="home-blog-post">
                        <div class="image"><img width="150" height="150"
                                                src="{{ URL::to('/') }}/public/imgbranch/53.jpg"
                                                alt="..." class="img-fluid">
                            <div class="overlay d-flex align-items-center justify-content-center"><a href="{{ URL::to('/branch-result/53') }}"
                                                                                                     class="btn btn-template-outlined-white"><i
                                        class="fa fa-chain"> </i>Nhiều hơn</a></div>
                        </div>
                        <div class="text">
                            <h4><a href="{{ URL::to('/branch-result/53') }}">Đồ lưu niệm</a></h4>
                            <p class="intro"></p><a href="{{ URL::to('/branch-result/53') }}"
                                                    class="btn btn-template-outlined">Hiển thị tất cả</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section class="bar background-white">
        <div class="container text-center">
            <div class="heading text-center">
                <h2>Tại sao bạn chọn BookShop</h2>
            </div>
            <p class="lead">6 lý do tin dùng sản phẩm tại bookshop</p>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="box-simple">
                        <div class="icon-outlined"><i class="	fa fa-dollar"></i></div>
                        <h3 class="h4">Tiết kiệm</h3>
                        <p>Chúng tôi luôn cung cấp những đầu sách tốt nhất với mức giá cạnh tranh nhấty</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box-simple">
                        <div class="icon-outlined"><i class="fa fa-home"></i></div>
                        <h3 class="h4">Không gian sang trọng</h3>
                        <p>Với kiến trúc hiện đại nhưng ko kém phần tĩnh lặng rất phù hợp với những khách hàng cần một
                            nơi thư giãn để đọc sách, BookShop sẽ đem đến
                            cho quý khách những trải nghiệm tuyệt vời</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box-simple">
                        <div class="icon-outlined"><i class="fa fa-globe"></i></div>
                        <h3 class="h4">Nhiều chi nhánh trên toàn quốc</h3>
                        <p>Với hơn 3000+ chi nhánh của BookStore trên toàn quốc, chúng tôi luôn sẵn sàng phục vụ dù bạn
                            ở bất kì nơi đâu</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="box-simple">
                        <div class="icon-outlined"><i class="fa fa-ambulance"></i></div>
                        <h3 class="h4">Giao hàng cực nhanh</h3>
                        <p>Các bạn chỉ cần ngồi tại nhà và đặt hàng, chúng tôi sẽ giao hàng trong thời gian nhanh
                            nhất</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box-simple">
                        <div class="icon-outlined"><i class="fa fa-phone"></i></div>
                        <h3 class="h4">Chế độ hậu mãi tốt</h3>
                        <p>Chúng tôi luôn đặt niềm tin của khách hàng lên hàng đầu, bất kì thắc mắc và khiếu nại về sản
                            phẩm chúng tôi luôn
                            cố gắng đưa ra những giải pháp tốt nhất để làm hài lòng ngay cả những khách hàng khó tính
                            nhất</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="box-simple">
                        <div class="icon-outlined"><i class="fa fa-user"></i></div>
                        <h3 class="h4">Nhân viên lịch sự và thân thiện</h3>
                        <p>Nhân viên bookstore là những người luôn niềm nở và thân thiện với khách hàng trong bất kì
                            tình huống nào</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="get-it">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-center p-3">
                    <h3>Bạn muốn mua sách chất lượng với mức giá ưu đãi?</h3>
                </div>
                <div class="col-lg-4 text-center p-3"><a href="#" class="btn btn-template-outlined-white">Vui lòng liên
                        hệ chúng tôi</a></div>
            </div>
        </div>
    </div>
@endsection
