@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý đơn hàng của người dùng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>ID Oder</th>
                                <th>Khách hàng</th>
                                <th>Ngày mua</th>
                                <th>Duyệt đơn hàng</th>
                                <th>Ghi chú</th>
                                <th>Xem chi tiết</th>
                                <th>Tỉnh thành</th>
                                <th>Thành Tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allOrder as $eachOrder)
                                <tr>
                                    <td>{{ $eachOrder->id_oder }}</td>
                                    <td style="color: deeppink">
                                        <?php
                                        $cus = DB::table('customer')->where('id_customer',$eachOrder->id_customer)->get()->first();
                                        ?>

                                            {{$cus->name}}

                                    </td>
                                    <td>{{ $eachOrder->date }}</td>
                                    <td>

                                        <?php
                                        if($eachOrder->isapproved == 0){    //chưa duyệt
                                        ?>
                                        <p style="color: #ba8b00">Chờ Phê duyệt</p>
                                        <a href="{{URL::to('/approve-order/'.$eachOrder->id_oder)}}">Duyệt</a>
                                            |
                                        <a href="{{URL::to('/unapprove-order/'.$eachOrder->id_oder)}}">Hủy</a>

                                        <?php
                                        }else if($eachOrder->isapproved == 1){ //đã duyệt
                                        ?>
                                        <p style="color: blue">Đã duyệt</p>
                                        <a href="{{URL::to('/succeed-order/'.$eachOrder->id_oder)}}">Xác Nhận Giao Thành Công</a>

                                        <?php
                                        } else if($eachOrder->isapproved == 2){ //giao thành công
                                        ?>

                                        <p style="color: green">Đã giao hàng thành công</p>

                                        <?php
                                        }  else if($eachOrder->isapproved == 3){ //bị hủy
                                        ?>

                                        <p style="color: red">Đơn hàng bị hủy</p>

                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $eachOrder->note }}</td>
                                    <td><a href="{{URL::to('/view-order-detail/'.$eachOrder->id_oder)}}">Chi tiết</a></td>
                                    <?php
                                    $provin = DB::table('province')->where('id_province',$eachOrder->id_province)->get()->first();
                                    ?>
                                    <td>{{ $provin->name }}</td>
                                    <td style="color: peru">{{ $eachOrder->totalcost }}</td>

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
