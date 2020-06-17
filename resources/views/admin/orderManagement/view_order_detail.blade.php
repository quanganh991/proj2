@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color: red" class="card-title">Chi tiết đơn hàng mã {{$DONHANG->id_oder}} của khách hàng: <label style="color: purple">{{$KH}}</label></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID Đơn hàng chi tiết</th>
                                <th>Sản phẩm</th>
                                <th>Hình Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giảm giá</th>
                                <th>Đối tác Giao hàng</th>
                                <th>Giá</th>
                                <th>Ngày mua</th>
                                <th>Phí ship</th>
                                <th>Sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allOrderDetail as $eachOrderDetail)
                                <tr>
                                    <td>{{ $eachOrderDetail->item_order }}</td>
                                    <td>{{ $eachOrderDetail->id_oder_detail }}</td>
                                    <td>
                                        <?php
                                        $sp = DB::table('product')->where('id_product',$eachOrderDetail->id_product)->get()->first();
                                        ?>
                                            <a href="{{URL::to('/detail/'.$sp->id_product) }}">{{$sp->name}}</a>
                                    </td>
                                    <td><a href="{{URL::to('/detail/'.$sp->id_product) }}">
                                            <img width="100" height="100" src="{{ URL::to('/') }}/public/imgproduct/{{$sp->image}}" class="img-fluid">
                                        </a></td>
                                    <td>{{ $eachOrderDetail->quantity }}</td>
                                    <td>{{ $eachOrderDetail->discount }}</td>
                                    <?php
                                    $delivery =  DB::table('partner_delivery')->where('id_partner_delivery',$eachOrderDetail->id_partner_delivery)->get()->first();
                                    ?>
                                    <td style="color: green">{{$delivery ->name }}</td>
                                    <td style="color: red">{{ $sp->price }}</td>
                                    <td>{{ $DONHANG->date }}</td>
                                    <td>{{ $eachOrderDetail->shipping_fee }}</td>
                                    <td><a href="{{URL::to('/edit-order-detail/'.$eachOrderDetail->id_oder_detail)}}">Sửa</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
