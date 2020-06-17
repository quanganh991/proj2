@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-product')}}" method="GET">
                            <input type="hidden" name="id_product" value="{{$edit_product->id_product}}">
                            <div class="form-group">
                                <label>Tên Branch</label>
{{--                                <input type="text" name="id_category_branch" class="form-control" id="id_main"--}}
{{--                                       value="{{$edit_product->id_category_branch}}">--}}
                                <?php
                                $bra = DB::table('category_branch')->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_category_branch" id="id_category_branch" >
                                    @foreach($bra as $indexbra)
                                        <option
                                            <?php if($indexbra->id_category_branch ==  $edit_product->id_category_branch) echo "selected" ?>
                                            value="{{$indexbra->id_category_branch}}">{{$indexbra->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="product_name"
                                       value="{{$edit_product->name}}">
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="product_descr"
                                          id="product_descr">{{$edit_product->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="product_image" class="form-control" id="product_logo"
                                       value="{{$edit_product->image}}" required>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="text" name="product_amount" class="form-control" id="product_amount"
                                       value="{{$edit_product->amount}}">
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" name="product_price" class="form-control" id="product_price"
                                       value="{{$edit_product->price}}">
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="product_isActive" class="form-control input-sm m-bot15">
                                    <option value="0">Ngừng kinh doanh</option>
                                    <option value="1">Còn hàng</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Giá thị trường</label>
                                <input type="text" name="market_price" class="form-control" id="market_price"
                                       value="{{$edit_product->market_price}}">
                            </div>

                            <div class="form-group">
                                <label>Số trang </label>
                                <input type="text" name="page" class="form-control" id="page"
                                       value="{{$edit_product->page}}">
                            </div>
                            <div class="form-group">
                                <label>SKU</label>
                                <input type="number" name="sku" class="form-control" id="sku" value="{{$edit_product->sku}}">
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <input type="text" name="author" class="form-control" id="author" value="{{$edit_product->author}}">
                            </div>
                            <div class="form-group">
                                <label>Nhà xuất bản</label>
                                <input type="text" name="publisher" class="form-control" id="publisher" value="{{$edit_product->publisher}}">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Sửa</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
