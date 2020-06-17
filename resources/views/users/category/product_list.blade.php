@extends('welcome', ['app' => $app])
@section('product')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">{{$nameBranch->name}}</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{URL::to('/branch-result/'.$MainOnly->id_category_main)}}">{{$MainOnly->name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="container">
            <section class="bar">
                <!-- Show info branch -->
                <div  style="color: #f39c12" class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2><a href="{{URL::to('/product-result/'.$idBranch)}}">{{$nameBranch->name}}</a></h2>
                        </div>
                        <p class="lead">{{$nameBranch->descriptionf}}</p>
                    </div>
                </div>
                <!-- End show info branch -->

                {{--lọc sản phẩm--}}
                <h3 style="color: red">{{$filter}}</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target=".bs-example-modal-lg">Lọc
                </button>
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg-12" role="document">
                        <div class="modal-content">
                            <div class="modal-body ">
                                <section>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Lọc nâng cao</h3>
                                                    </div>
                                                    <form role="form" action="{{URL::to('/product-result/'.$idBranch)}}"
                                                          method="GET">
                                                        {{ csrf_field() }}
                                                        <div class="card-body">

                                                            <div class="form-group">
                                                                <label>Khoảng Giá</label>
                                                                <input required type="text" name="product_price"
                                                                       class="form-control" id="product_price"
                                                                       placeholder="price range">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Trạng thái</label>
                                                                <select name="product_status"
                                                                        class="form-control input-sm m-bot15">
                                                                    <option value="0">Ngừng kinh doanh</option>
                                                                    <option value="1">Còn hàng</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Khoảng Giá thị trường </label>
                                                                <input required type="number" name="market_price"
                                                                       class="form-control" id="market_price"
                                                                       placeholder="market price">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Số trang </label>
                                                                <input required type="text" name="page"
                                                                       class="form-control" id="page"
                                                                       placeholder="Số trang: ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tác giả </label>
                                                                <textarea type="text" name="author"
                                                                          class="form-control"
                                                                          id="author"
                                                                          placeholder="author"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nhà xuất bản </label>
                                                                <textarea type="text" name="publisher"
                                                                          class="form-control"
                                                                          id="publisher"
                                                                          placeholder="publisher"></textarea>
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">
                                                                <button type="submit" name="add_product"
                                                                        class="btn btn-primary">Lọc
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                {{--lọc--}}

                <div class="row portfolio text-center">

                    @foreach($productSearch as $key => $productSearchValue)
                        <div class="col-md-3">
                            <div class="box-image">
                                <div class="image"><img width="300" height="300"
                                        src="{{ URL::to('/') }}/public/imgproduct/{{$productSearchValue->image}}" alt=""
                                        class="img-fluid">
                                    <div class="overlay d-flex align-items-center justify-content-center">
                                        <div class="content">
                                            <div class="name">
                                                <h3><a href="{{URL::to('/detail/'.$productSearchValue->id_product) }}"
                                                       class="color-white">{{$productSearchValue->name}}</a></h3>
                                            </div>
                                            <div class="text">
                                                <p class="buttons"><a
                                                        href="{{URL::to('/detail/'.$productSearchValue->id_product) }}"
                                                        class="btn btn-template-outlined-white">Xem chi tiết</a>
                                                    <form action="{{URL::to('/save-cart')}}" method="GET">
                                                        <input type="hidden" name="quantity" value="1"/>
                                                        <input name="productid_hidden" type="hidden"
                                                               value="{{$productSearchValue->id_product}}"/>
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
                                <h5>{{$productSearchValue->name}}</h5>
                                <h5 style="color: red">$.{{$productSearchValue->price}}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

@endsection
