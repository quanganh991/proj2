@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa thông tin đối tác giao hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-partner-delivery')}}" method="GET">
                            <input type="hidden" name="id_partner_delivery"
                                   value="{{$edit_partner_delivery->id_partner_delivery}}">
                            <div class="form-group">
                                <label>Tên đối tác giao hàng</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       value="{{$edit_partner_delivery->name}}">
                            </div>

                            <div class="form-group">
                                <label>Phí ship đếm</label>
                                <input type="number" name="shipping_fee" class="form-control" id="shipping_fee"
                                       value="{{$edit_partner_delivery->shipping_fee}}">
                            </div>

                            <div class="form-group">
                                <label>Phí ship đi</label>
                                <input type="number" name="return_fee" class="form-control" id="return_fee"
                                       value="{{$edit_partner_delivery->return_fee}}">
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
