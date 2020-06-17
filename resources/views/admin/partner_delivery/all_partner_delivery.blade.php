@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục đối tác giao hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Form add new product -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Thêm mới đối tác giao hàng</button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div >
                                                <div class="row">
                                                    <!-- left column -->

                                                    <div class="col-md-12">
                                                        <!-- general form elements -->
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm mới đối tác giao hàng</h3>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <!-- form start -->
                                                            <form action="{{URL::to('/save-partner-delivery')}}" method="GET">
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Tên đối tác giao hàng</label>
                                                                        <input type="text" class="form-control" name="name" id="name" placeholder="partner delivery name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label >Phí ship</label>
                                                                        <input type="text" class="form-control" name="shipping_fee" id="shipping_fee" placeholder="shipping fee">
                                                                    </div>
                                                                    <!-- /.card-body -->

                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_branch" class="btn btn-primary">Lưu</button>
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
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID đối tác giao hàng</th>
                                <th>Tên đối tác giao hàng</th>
                                <th>Phí ship đến</th>
                                <th>Phí ship đi</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allPartnerDelivery as $eachPartnerDelivery)
                                <tr>
                                    <td>{{ $eachPartnerDelivery->id_partner_delivery }}</td>
                                    <td style="color: red">{{ $eachPartnerDelivery->name }}</td>
                                    <td style="color: green">{{ $eachPartnerDelivery->shipping_fee }}</td>
                                    <td>
                                        <a href="{{URL::to('/edit-partner-delivery/'.$eachPartnerDelivery->id_partner_delivery)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
