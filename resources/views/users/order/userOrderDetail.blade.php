@extends('welcome')
@section('order')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Xem chi tiết đơn hàng</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item">Xem chi tiết đơn hàng</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-sm">
    <div>
        <h1 style="text-align:center; color: red">Có {{$countAllUserOrderDetail}} sản phẩm trong đơn hàng có mã: {{$idDonHang}}</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Chiết khấu</th>
                    <th>Giá bìa</th>
                    <th>Đối tác giao hàng</th>
                    <th>VAT</th>
                    <th>Ngày mua</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @if($countAllUserOrderDetail>0)
                @foreach($allUserOrderDetail as $eachUserOrderDetail)
                <tr>
                    <td>{{ $eachUserOrderDetail->item_order }}</td>
                    <td>
                        <?php
                        $tensp = DB::table('product')->where('id_product',$eachUserOrderDetail->id_product )->get()->first();
                        ?>
                        <a href="{{URL::to('/detail/'.$tensp->id_product) }}">
                            {{ $tensp->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{URL::to('/detail/'.$tensp->id_product) }}">
                            <img src="{{ URL::to('/') }}/public/imgproduct/{{$tensp->image}}" class="img-fluid">
                        </a>
                    </td>
                    <td>{{ $eachUserOrderDetail->quantity }}</td>
                    <td>{{ $eachUserOrderDetail->discount }}</td>
                    <td>{{ $eachUserOrderDetail->subprice }}</td>
                    <?php
                    $delivery =  DB::table('partner_delivery')->where('id_partner_delivery', $eachUserOrderDetail->id_partner_delivery)->get()->first();
                    ?>
                    <td style="color: orangered">{{$delivery ->name }}</td>
                    <td>{{ $eachUserOrderDetail->VAT }}</td>
                    <td>{{ $eachUserOrderDetail->boughtdate }}</td>
                    <td>
                        <?php
                        $statu = DB::table('oder')->where('id_oder',$idDonHang)->get()->first()->isapproved;
                        ?>
                        @if($statu == 0) {{--đơn hàng nào chưa được duyệt thì user có thể hủy--}}
                        <h5 style="color: dodgerblue">Đang chờ phê duyệt</h5>
                        @elseif($statu == 1) {{--đơn hàng đang được vận chuyển--}}
                        <h5 style="color: orangered">Đang vận chuyển</h5>
                        @elseif($statu == 2) {{--đơn hàng đã giao thành công--}}
                        <h5 style="color: green">Đã giao thành công</h5>
                        @elseif($statu == 3) {{--đơn hàng bị hủy--}}
                        <h5 style="color: black">Đơn hàng bị hủy</h5>
                        @endif

                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
