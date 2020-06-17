@extends('welcome')
@section('product_detail')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 style="color: darkorange" class="h2">{{$queryy->name}}</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{URL::to('/branch-result/'.$queryy->id_category_main)}}">{{$categoryMainOnly->name}}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{URL::to('/product-result/'.$queryy->id_category_branch)}}">{{$categoryBranchOnly->name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="col-lg-12">
                <p></p>
                <p class="goToDescription"><a href="#details" class="scroll-to text-uppercase">Xem giới thiệu</a></p>
                <div id="productMain" class="row">
                    <div class="col-sm-6">
                        <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                            <div><img src="{{ URL::to('/') }}/public/imgproduct/{{$queryy->image}}"
                                      alt="{{$queryy->image}}" class="img-fluid"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- <div class="box"> -->
                        <form action="{{URL::to('/save-cart')}}" method="GET">

                            <input name="productid_hidden" type="hidden" value="{{$queryy->id_product}}"/>
                            <h5 style="text-decoration: line-through;">Giá thị trường: {{$queryy->market_price}} $</h5>
                            <h3 class="price">Giá tại MyBookStore: <label style="color: red">{{$queryy->price}}$</label></h3>
                            <h4 style="color: yellowgreen">{{$queryy->name}}</h4>
                            <h5 style="color: darkviolet">Số trang: {{$queryy->page}}</h5>
                            <h5 style="color: lawngreen">SKU: {{$queryy->sku}}</h5>
                            <h5 style="color: #fd7605">Tác giả: {{$queryy->author}}</h5>
                            <h5 style="color: blue">Nhà xuất bản: {{$queryy->publisher}}</h5>
                            <div>
                                <h3 style="color: #0f6674">
                                <label>
                                    Số lượng
                                    <input class="form-control" type="number" id="example-number-input"/>
                                </label>
                                </h3>
                                <select name="quantity" class="bs-select">
                                    @for ($i = 1; $i <= $queryy->amount; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @if ($queryy->amount == 1)
                                    <h6>Chỉ còn 1 sản phẩm duy nhất</h6>
                                @else
                                    <h6>Còn {{$queryy->amount}} sản phẩm trong kho hàng</h6>
                                @endif
                            </div>

                            @if($queryy->isactive == 0)
                                <row>Trạng thái: <label style="color:red;">Hết hàng</label></row>
                            @endif
                            @if($queryy->isactive == 1)
                                <row>Trạng thái: <label style="color:red;">Còn hàng</label></row>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-template-outlined"><i
                                            class="fa fa-shopping-cart"></i>Cho vào giỏ hàng
                                    </button>
                                    <button type="submit" data-toggle="tooltip" data-placement="top"
                                            title="Add to wishlist" class="btn btn-default"><i
                                            class="fa fa-heart-o"></i></button>
                                </p>
                            @endif
                        </form>
                    </div>
                </div>
                <div id="details" class="box mb-4 mt-4">
                    <h2 style="color: #2b527e">Giới thiệu về sản phẩm</h2>
                    <h4 style="color: #00c054">{{$queryy->description}}</h4>
                </div>
            </div>
            <div>
                <h1 style="color: red">Đánh giá:</h1>
                @if( $queryy->ratequantity == 0)
                    <h4 style="color: deeppink">Chưa được người dùng đánh giá</h4>
                @else
                    <h4 style="color: deeppink">Đã có {{$queryy->ratequantity}} người dùng đánh giá</h4>
                @endif
                <h4>Trung bình: {{$queryy->rate}}</h4>

                <div class="col-lg-3">
                    <form action="{{URL::to('/rating')}}" method="GET">
                        <input name="productid_hidden" type="hidden" value="{{$queryy->id_product}}"/>
                        <select class="form-control form-control-sm" name="point" id="point">
                            @for ($i = 0; $i <= 10; $i++)
                                <option>{{$i}}</option>
                            @endfor
                        </select>
                        <button type="submit" class="btn-template-main">Đánh giá</button>
                    </form>
                </div>
                <hr>
                <hr>
                <hr>
                <h1 style="color: orangered">Bình luận:</h1>
                <?php
                if (Session::get('id_customer')) {
                ?>
                <form action="{{URL::to('/comment')}}" method="GET">
                    <textarea name="comment" placeholder="Đánh giá sản phẩm" rows="6" cols="50"></textarea>
                    <input name="productid_hidden" type="hidden" value="{{$queryy->id_product}}"/>
                    <input name="customerid_hidden" type="hidden" value="{{Session::get('id_customer')}}"/>
                    <br>
                    <button type="submit" class="btn-template-main">Gửi bình luận</button>
                </form>
                <?php
                } else if (Session::get('id_admin')) {
                ?>
                <form action="{{URL::to('/admin-comment')}}" method="GET">
                        <textarea name="comment" placeholder="Admin muốn thông báo gì về sản phẩm??" rows="6"
                                  cols="50"></textarea>
                    <input name="productid_hidden" type="hidden" value="{{$queryy->id_product}}"/>
                    <input name="adminid_hidden" type="hidden" value="{{Session::get('id_admin')}}"/>
                    <br>
                    <button type="submit" class="btn-template-main">Gửi bình luận với tư cách Admin</button>
                </form>
                <?php
                } else {
                    echo "Bạn phải đăng nhập để bình luận";
                }
                $adminCommentList = DB::table('coment_admin') //chứa coment của ad
                ->join('admininfo', 'admininfo.id_admin', '=', 'coment_admin.id_admin')
                    ->where('coment_admin.id_product', $queryy->id_product)
                    ->get();

                $commentList = DB::table('coment')  //chứa coment của user
                ->join('customer', 'customer.id_customer', '=', 'coment.id_customer')
                    ->where('coment.id_product', $queryy->id_product)
                    ->get();
                ?>
                @foreach($adminCommentList as $eachAdminCommentList)
                    <row>
                        <hr>
                        <h4><label style="color:red;">{{$eachAdminCommentList->name}} - Admin</label></h4>
                        <h5><i class="fa fa-comment" aria-hidden="true"></i> {{$eachAdminCommentList->content}}</h5>

                        <?php
                        if (Session::get('id_admin') === $eachAdminCommentList->id_admin) {
                        ?>
                        <a href="{{URL::to('/delete-admin-comment/'.$eachAdminCommentList->id_coment)}}">Xóa bình luận</a>
                        <?php
                        }
                        ?>
                    </row>
                @endforeach

                @foreach($commentList as $eachCommentList)
                    <row>
                        <?php
                        $user = DB::table('customer') //chứa coment của ad
                        ->where('id_customer', $eachCommentList->id_customer)
                            ->get()->first();
                        if ($user->status == 1) {
                        ?>
                        <hr>
                        <h4 style="color: #2b527e">Người dùng: {{$eachCommentList->name}}</h4>
                        <?php
                        } else if ($user->status == 0) {
                        ?>
                        <hr>
                        <h4>
                            <row style="text-decoration: line-through;">Người dùng: {{$eachCommentList->name}}</row>Tài khoản này đã bị khóa
                        </h4>
                        <?php
                        }
                        ?>
                            <h5><i class="fa fa-comment" aria-hidden="true"></i> {{$eachCommentList->content}}</h5>
                        <?php
                        if (Session::get('id_admin')) {
                        ?>
                        <a href="{{URL::to('/delete-comment/'.$eachCommentList->id_coment)}}">Xóa comment</a>
                            |
                        <a href="{{URL::to('/block-user/'.$eachCommentList->id_customer)}}">Khóa tài khoản</a>
                            |
                        <a href="{{URL::to('/unblock-user/'.$eachCommentList->id_customer)}}">Mở khóa tài khoản</a>
                        <?php
                        }
                        ?>
                    </row>
                    <hr>
                    <hr>
                @endforeach
                <h1 style="color: red">Sản phẩm tương tự</h1>
                <div class="row portfolio text-center">
                    <?php
                    $equalProduct = DB::table('product')
                        ->where('id_category_branch', $queryy->id_category_branch)
                        ->take(8)
                        ->get();    //sp tương đương là các sp có cùng branch-category
                    $url = $categoryMainOnly->name . '/' . $categoryBranchOnly->name . '/';

                    foreach ($equalProduct as $eachOfEqualProduct) {
                    ?>

                    <div class="col-md-3">
                        <div class="box-image">
                            <div class="image"><img
                                    src="{{ URL::to('/') }}/public/imgproduct/{{$eachOfEqualProduct->image}}" alt=""
                                    class="img-fluid">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <div class="content">
                                        <div class="name">
                                            <h3><a href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
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
                                                        class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                </button>
                                            </p>
                                            </form>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5>{{$eachOfEqualProduct->name}}</h5>
                            <h5 style="color: red">$.{{$eachOfEqualProduct->price}}</h5>
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
                <hr>
                <hr>
                <h1 style="color: blue">Bài viết liên quan</h1>
                <?php
                $equalNews = DB::table('news')
                    ->where('id_product', $queryy->id_product)
                    ->get();
                foreach ($equalNews as $eachOfEqualNews) {
                ?>
                <h4 style="color: orangered">
                    <a href="{{URL::to('/detail-news-for-user/'.$eachOfEqualNews->id_news) }}">
                        {{$eachOfEqualNews->title}}
                        ({{$eachOfEqualNews->publish_date}})</a></h4>
                <?php
                }
                ?>
                <hr>
                <hr>
                <h1 style="color: deeppink">Cùng mức giá</h1>
                <div class="row portfolio text-center">
                    <?php
                    $equalProduct = DB::table('product')
                        ->where('price', '>=', $queryy->price * 0.7)
                        ->where('price', '<=', $queryy->price * 1.3)
                        ->orderBy('price', 'DESC')
                        ->take(8)
                        ->get();    //xem các sp cùng phân khúc giá
                    $url = $categoryMainOnly->name . '/' . $categoryBranchOnly->name . '/';

                    foreach ($equalProduct as $eachOfEqualProduct) {
                    ?>

                    <div class="col-md-3">
                        <div class="box-image">
                            <div class="image"><img
                                    src="{{ URL::to('/') }}/public/imgproduct/{{$eachOfEqualProduct->image}}" alt=""
                                    class="img-fluid">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <div class="content">
                                        <div class="name">
                                            <h3><a href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
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
                                                        class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
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
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
                <hr>
                <hr>
                <h1 style="color: #7d34f4">Cùng tên</h1>
                <div class="row portfolio text-center">
                    <?php
                    $equalProduct = DB::table('product')
                        ->where('name', 'like', '%' . $queryy->name . '%')
                        ->take(8)
                        ->get();    //xem các sp mới nhất
                    $url = $categoryMainOnly->name . '/' . $categoryBranchOnly->name . '/';

                    foreach ($equalProduct as $eachOfEqualProduct) {
                    ?>

                    <div class="col-md-3">
                        <div class="box-image">
                            <div class="image"><img
                                    src="{{ URL::to('/') }}/public/imgproduct/{{$eachOfEqualProduct->image}}" alt=""
                                    class="img-fluid">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <div class="content">
                                        <div class="name">
                                            <h3><a href="{{URL::to('/detail/'.$eachOfEqualProduct->id_product) }}"
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
                                                        class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
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
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
                <hr>
                <hr>
            </div>
        </div>
    </div>

@endsection
