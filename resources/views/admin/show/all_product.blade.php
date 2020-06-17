@extends('admin.welcomeAdmin')
@section('all_product')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm sản phẩm mới
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
                                                                <h3 class="card-title">Thêm sản phẩm mới</h3>
                                                            </div>
                                                            <form role="form" action="{{URL::to('/save-product')}}"
                                                                  method="GET">
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="branch">Branch của sản phẩm</label>
                                                                        <?php
                                                                        $bra = DB::table('category_branch')->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_category_branch"
                                                                                id="id_category_branch">
                                                                            @foreach($bra as $indexbra)
                                                                                <option
                                                                                    value="{{$indexbra->id_category_branch}}">{{$indexbra->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Product_name">Tên sản phẩm</label>
                                                                        <input type="text" name="product_name"
                                                                               class="form-control" id="product_name"
                                                                               placeholder="Product Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Mô tả sản phẩm</label>
                                                                        <input type="text" class="form-control"
                                                                               name="product_descr" id="product_descr"
                                                                               placeholder="Description product">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="image">Hình ảnh</label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                       class="custom-file-input"
                                                                                       name="product_image"
                                                                                       id="product_image">
                                                                                <label class="custom-file-label"
                                                                                       for="image">Chọn tệp</label>
                                                                            </div>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text" id="">Tải lên</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Số lượng</label>
                                                                        <input type="text" name="product_amount"
                                                                               class="form-control" id="product_amount"
                                                                               placeholder="amount of product">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Giá </label>
                                                                        <input type="text" name="product_price"
                                                                               class="form-control" id="product_price"
                                                                               placeholder="price ">
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
                                                                        <label>Giá thị trường </label>
                                                                        <input type="number" name="market_price"
                                                                               class="form-control" id="market_price"
                                                                               placeholder="market price">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Số trang </label>
                                                                        <input type="text" name="page"
                                                                               class="form-control" id="page"
                                                                               placeholder="Số trang: ">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>SKU </label>
                                                                        <textarea type="number" name="sku"
                                                                                  class="form-control"
                                                                                  id="sku"
                                                                                  placeholder="SKU"></textarea>
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
                                                                                class="btn btn-primary">Thêm sản phẩm
                                                                            mới
                                                                        </button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end form -->
                        <br></br>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID Sản phẩm</th>
                                <th>Branch của sản phẩm</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Giá thị trường</th>
                                <th>Trạng thái</th>
                                <th>Nhà xuất bản</th>
                                <th>Tác giả</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allProduct as $eachProduct)
                                <?php
                                $categoryBranchOnly = DB::table('category_branch')->where('id_category_branch', $eachProduct->id_category_branch)->get()->first();   //chứa 1 bản ghi trong bảng branch
                                $categoryMainOnly = DB::table('category_main')->where('id_category_main', $categoryBranchOnly->id_category_main)->get()->first();
                                ?>
                                <tr>
                                    <td>{{ $eachProduct->id_product }}</td>
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/edit-branch-category/'.$categoryBranchOnly->id_category_branch) }}">
                                            {{$categoryBranchOnly->name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: rebeccapurple"
                                           href="{{URL::to('/detail/'.$eachProduct->id_product) }}">{{ $eachProduct->name }}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/detail/'.$eachProduct->id_product) }}">
                                            <img width="100" height="100"
                                                 src="{{ URL::to('/') }}/public/imgproduct/{{$eachProduct->image}}"
                                                 alt="" class="img-fluid">
                                        </a>
                                    </td>
                                    <td>{{ $eachProduct->amount }}</td>
                                    <td style="color: green">{{ $eachProduct->price }}</td>
                                    <td style="color: #0f401b">{{ $eachProduct->market_price }}</td>
                                    <td>
                                        <?php
                                        if($eachProduct->isactive == 1){
                                        ?>
                                        <p style="color: green">Còn hàng</p>
                                        <a href="{{URL::to('/unactive-product/'.$eachProduct->id_product)}}">Ngừng kinh
                                            doanh</a>
                                        <?php
                                        }else{ //if ($eachProduct->_status==0)
                                        ?>
                                        <p style="color: red">Hết Hàng</p>
                                        <a href="{{URL::to('/active-product/'.$eachProduct->id_product)}}">Tiếp tục kinh
                                            doanh</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $eachProduct->publisher }}</td>
                                    <td>{{ $eachProduct->author }}</td>
                                    <td>
                                        <a href="{{URL::to('/edit-product/'.$eachProduct->id_product)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allProduct->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
