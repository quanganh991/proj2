@extends('welcome')
@section('noteDetail')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 style="color: red" class="h2">Điền thông tin nhận hàng</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Điền thông tin nhận hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="container">
            <div class="row">
                <div id="checkout" class="col-lg-9">
                    <div class="box border-bottom-0">
                        <form action="{{URL::to('/save-customer-payment')}}" method="GET">
                            <div>
                                <input type="hidden" value="{{$customerInformation->id_customer}}" name="id_customer">
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: red" for="email">Email người nhận</label>
                                    <input class="form-control" type="text" name="shipping_email" placeholder="Email"
                                           value="{{$customerInformation->email}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: red" for="name">Tên người nhận</label>
                                    <input class="form-control" type="text" name="shipping_name" placeholder="Name"
                                           value="{{$customerInformation->name}}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: red" for="address">Địa chỉ nhận hàng</label>
                                    <input class="form-control" type="text" name="shipping_address"
                                           placeholder="Address" value="{{$customerInformation->address}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: red" for="phone">Số điện thoại nhận hàng</label>
                                    <input class="form-control" type="text" name="shipping_phone" placeholder="Phone"
                                           value="{{$customerInformation->phone_number}}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: red" for="exampleFormControlTextarea1">Ghi chú: </label>
                                    <textarea class="form-control" name="shipping_notes" placeholder="Note" rows="8"
                                              cols="50"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">

                                    <?php
                                    $prov = DB::table('province')->where('id_province', $dest)->get()->first();
                                    ?>
                                    <label style="color: red">Tỉnh thành của bạn: {{$prov->name}}
                                        <input style="color: red" readonly hidden value="{{$dest}}" required
                                               name="shipping_province" type="text" placeholder="Province">
                                    </label>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="payment_option" value="ATM" type="radio"
                                       id="check1">
                                <label class="form-check-label" for="check1">
                                    Thẻ ngân hàng
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="payment_option" value="Tiền mặt" type="radio"
                                       id="check2">
                                <label class="form-check-label" for="check2">
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="payment_option" value="Ví momo" type="radio"
                                       id="check3">
                                <label class="form-check-label" for="check3">
                                    Ví Momo
                                </label>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>

                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>

                                        <th>Thuế VAT</th>

                                        <th>Đơn giá (Có VAT)</th>
                                        <th>Khuyến mại</th>
                                        <th>Thành Tiền</th>
                                        <th>Giá bìa (Chưa VAT)</th>
                                        <th>Đối tác giao hàng</th>
                                        <th>Phí vận chuyển</th>
                                    </tr>
                                    </thead>
                                    <?php $content = Cart::content();
                                    $i = 0; ?>
                                    @foreach($content as $eachContentItem)
                                        <tr>
                                            <?php
                                            $produc = DB::table('product')->where('id_product', $eachContentItem->id)->get()->first();
                                            $categoryBranchOnly = DB::table('category_branch')->where('id_category_branch', $produc->id_category_branch)->get()->first();   //chứa 1 bản ghi trong bảng branch
                                            $categoryMainOnly = DB::table('category_main')->where('id_category_main', $categoryBranchOnly->id_category_main)->get()->first();
                                            ?>
                                            <td>
                                                <a href="{{URL::to('/detail/'.$produc->id_product) }}">
                                                    <img src="{{ URL::to('/') }}/public/imgproduct/{{$produc->image}}"
                                                         class="img-fluid">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{URL::to('/detail/'.$produc->id_product) }}">{{$eachContentItem->name}}</a>
                                            </td>
                                            <td>{{$eachContentItem->qty}}</td>
                                            <td style="color: #fd7605">{{$VAT[$i]}}</td>
                                            <td style="color: red">{{'$'.number_format($eachContentItem->price)}}</td>
                                            <td></td>
                                            <td style="color: gold">{{$totalEachCost[$i]}}</td>
                                            <td style="color: #00c054">
                                                {{$subprice[$i]}}
                                                <input hidden id="subprice[{{$i}}]" name="subprice[{{$i}}]"
                                                       style="float: left;" value="{{$subprice[$i]}}">
                                            </td>
                                            <td style="color: blue">
                                                <?php
                                                $delivery = DB::table('partner_delivery')->where('id_partner_delivery', $id_partner_delivery[$i])->get()->first();
                                                ?>
                                                {{$delivery->name}}
                                                <input hidden id="partner_delivery[{{$i}}]"
                                                       name="partner_delivery[{{$i}}]" style="float: left;"
                                                       value="{{$id_partner_delivery[$i]}}">
                                            </td>
                                            <td>
                                                {{$shipping_fee[$i]}}
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                        ?>
                                    @endforeach
                                </table>
                            </div>
                            <div style="text-align: center;">
                                <br>
                                @if(count($content) > 0)
                                    <input type="submit" value="Đặt hàng" name="send_order_place"
                                           class="btn btn-primary btn-sm">
                                @endif
                            </div>
                        </form>
                        <br>
                        <div style="text-align: center;">
                            @if(count($content) > 0)
                                <form action="{{URL::to('/destroy-cart')}}" method="GET">
                                    <input type="submit" value="Hủy giỏ hàng" name="destroy_cart" id="destroy_cart"
                                           class="btn btn-primary btn-sm">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div id="order-summary" class="box mt-0 mb-4 p-0">
                        <div class="box-header mt-0">
                            <h3>Thành tiền</h3>
                        </div>
                        <p class="text-muted">Lưu ý: Số tiền dưới đây đã bao gồm chi phí vận chuyển</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Tổng giá(Chưa bao gồm thuế VAT)</td>
                                    <th>{{"$".Cart::subTotal()}}</th>
                                </tr>
                                <tr>
                                    <td>VAT</td>
                                    <th>{{"$".Cart::tax()}}</th>
                                </tr>
                                <tr class="total">
                                    <td>Thành tiền</td>
                                    <th>{{"$".$totalcost}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
