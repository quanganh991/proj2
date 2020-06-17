
<!-- <header class="panel-heading">
    Thêm sản phẩm
</header>

<form action="{{URL::to('/save-product')}}" method="GET">
    {{ csrf_field() }}

    <div class="form-group">
        <label>ID của branch mà chứa product</label>
        <input type="text" name="id_category_branch" class="form-control" id="id_category_branch"
               placeholder="ID của branch">
    </div>

    <div class="form-group">
        <label>Tên product</label>
        <input type="text" name="product_name" class="form-control" id="product_name"
               placeholder="Tên product">
    </div>

    <div class="form-group">
        <label>Mô tả product</label>
        <textarea style="resize: none" rows="8" class="form-control" name="product_descr"
                  id="product_descr" placeholder="Mô tả product"></textarea>
    </div>

    <div class="form-group">
        <label>Image</label>
        <input type="file" name="product_image" class="form-control" id="product_image">
    </div>

    <div class="form-group">
        <label>Số lượng</label>
        <input type="text" name="product_amount" class="form-control" id="product_amount"
               placeholder="Số lượng">
    </div>

    <div class="form-group">
        <label>Giá: </label>
        <input type="text" name="product_price" class="form-control" id="product_price"
               placeholder="Giá: ">
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="product_status" class="form-control input-sm m-bot15">
            <option value="0">Còn hàng</option>
            <option value="1">Ngừng kinh doanh</option>
        </select>
    </div>

    <button type="submit" name="add_product" class="btn btn-info">Thêm product</button>
</form> -->
@extends('admin.show.all_product')
<!-- @extends('show/all_product') -->
@section('add_product')
<!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->

    <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-sm-6">
            <h1>Add New Product Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New Product</li>
            </ol>
          </div>
        </div>
      </div>
    </section> -->
    <?php   //notification, message,...
    $message = Session::get('message');
    if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session::put('message', null);
    }
    ?>
    <!-- Main content -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Click here</button>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-md-6">
    <div class="modal-body ">
    <section>
        <div >
            <div class="row">
                <!-- left column -->

                <div class="col-md-12">
                <!-- general form elements -->
                    <div class="card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Product</h3>
                        </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <form role="form" action="{{URL::to('/save-product')}}" method="GET">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Id_product">ID Branch</label>
                                <input type="text" class="form-control" name="id_category_branch" id="id_category_branch" placeholder="ID của branch">
                            </div>
                            <div class="form-group">
                                <label for="Product_name">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="product_descr" id="product_descr" placeholder="Mô tả product">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="product_image" id="product_image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng: </label>
                                <input type="text" name="product_amount" class="form-control" id="product_amount"
                                    placeholder="Số lượng">
                            </div>

                            <div class="form-group">
                                <label>Giá: </label>
                                <input type="text" name="product_price" class="form-control" id="product_price"
                                    placeholder="Giá: ">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Còn hàng</option>
                                    <option value="1">Tạm ngừng cho thuê</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Giá thị trường: </label>
                                <input type="text" name="market_price" class="form-control" id="market_price"
                                       placeholder="Giá thị trường: ">
                            </div>
                            <div class="form-group">
                                <label>id_province: </label>
                                <input type="text" name="id_province" class="form-control" id="id_province"
                                       placeholder="ID_Tỉnh: ">
                            </div>
                            <div class="form-group">
                                <label>Tình trạng: </label>
                                <input type="text" name="outlook" class="form-control" id="outlook"
                                       placeholder="Tình trạng: ">
                            </div>
                            <div class="form-group">
                                <label>Lịch sử sửa chữa: </label>
                                <textarea type="text" name="repair_history" class="form-control" id="repair_history">Số lần đã sửa chữa:</textarea>
                            </div>

                        <!-- /.card-body -->

                            <div class="card-footer">
                            <button type="submit" name="add_product" class="btn btn-primary">Add New Product</button>
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
@endsection
