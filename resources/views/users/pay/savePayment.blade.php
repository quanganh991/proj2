<section id="cart_items">
    @extends('welcome')
    @section('savePayment')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 style="color: yellowgreen" class="h2">Đơn hàng đã được gửi đi</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cảm ơn quý khách </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <section id="cart_items">
        <div class="container">

            <div class="review-payment">
                <h2 style="color: red">
                    Cảm ơn quý khách {{$shipping_name}} đã cho BookShop cơ hộp được phục vụ. Trong vòng 10 phút, nhân viên BookShop sẽ gọi điện hoặc gửi tin nhắn để xác nhận giao hàng
                </h2>
            </div>

            <h3 style="color: orange">Chi tiết đơn hàng</h3>
            <ul>
                <?php
                $custome = DB::table('customer')->where('id_customer', $id_customer)->get()->first();
                ?>
                <li style="color: #fd7605">Người đặt hàng: <span style="color: #ba8b00">{{$custome->name}}</span></li>
                <li style="color: #00c054">Địa chỉ nhận hàng: <span style="color: #ba8b00">{{$shipping_address}}</span></li>
                <li style="color: #00c054">Tên người nhận: <span style="color: #ba8b00">{{$shipping_name}}</span></li>
                <li style="color: #00c054">Email người nhận hàng: <span style="color: #ba8b00">{{$shipping_email}}</span></li>
                <li style="color: #00c054">Số điện thoại: <span style="color: #ba8b00">{{$shipping_phone}}</span></li>
                <li style="color: #00c054">Chú thích: <span style="color: #ba8b00">{{$shipping_notes}}</span></li>
                <li style="color: #00c054">Phương thức thanh toán: <span style="color: #ba8b00">{{$payment_option}}</span></li>
            </ul>
            <h1 style="color: orange">Sản phẩm đã mua:</h1>

            <?php
            $content = Cart::content(); //lấy nội dung của giỏ hàng
            //gồm id, qty, name, price, weight, option/image
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá bìa (Chưa bao gồm VAT)</th>
                        <th>Thuế VAT</th>
                        <th>Đơn giá (Bao gồm VAT)</th>
                        <th>Chiết khấu</th>
                        <th>Thành tiền</th>
                        <th>Đối tác giao hàng</th>
                        <th>Phí giao hàng</th>
                        <th>Ngày mua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                    $deposit = array();
                    $i = 0; ?>
                    @foreach($content as $eachContentItem) {{--duyệt tất cả sản phẩm trong giỏ hàng--}}
                    <tr>
                        <?php
                        $produc = DB::table('product')->where('id_product', $eachContentItem->id)->get()->first();
                        ?>
                        <?php
                        $produc = DB::table('product')->where('id_product', $eachContentItem->id)->get()->first();
                        $categoryBranchOnly = DB::table('category_branch')->where('id_category_branch', $produc->id_category_branch)->get()->first();   //chứa 1 bản ghi trong bảng branch
                        $categoryMainOnly = DB::table('category_main')->where('id_category_main', $categoryBranchOnly->id_category_main)->get()->first();
                        ?>
                        <td>{{$i+1}}</td>
                        <td>
                            <a href="{{URL::to('/detail/'.$produc->id_product) }}">
                                <img src="{{ URL::to('/') }}/public/imgproduct/{{$produc->image}}" class="img-fluid">
                            </a>
                        </td>
                        <td><a href="{{URL::to('/detail/'.$produc->id_product) }}">{{$eachContentItem->name}}</a></td>

                        <td class="cart_quantity">
                            <p>{{$eachContentItem->qty}}</p>
                        </td>
                            <td style="color: #fd7605">
                                {{$subprice[$i]}}
                            </td>
                            <td style="color: red">
                                {{$VAT[$i]}}
                            </td>

                        <td class="cart_price">
                            <p style="color: gold">{{number_format($eachContentItem->price).' '.'$'}}</p>
                        </td>
                        <td>{{Cart::discount()}}</td>
                        <td class="cart_total">
                            <p  style="color: #00c054"class="cart_total_price">
                                {{$totalEachCost[$i]}}
                            </p>
                        </td>
                        <td style="color: blue">{{DB::table('partner_delivery')->where('id_partner_delivery',$id_partner_delivery[$i])->get()->first()->name}}</td>
                        <td>{{$shipping_fees[$i]}}</td>
                        <td>{{$boughtdate}}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            <br>
            <ul>
                <li style="color: darkred">Tổng giá (chưa bao gồm VAT): <span style="color: deeppink">{{$totalcost* 0.9 .' '.'$'}}</span></li>
                <li style="color: darkred">Thuế VAT: <span style="color: deeppink">{{$totalcost* 0.1 .' '.'$'}}</span></li>
                <li style="color: darkred">Khuyến mại: <span style="color: deeppink">{{Cart::discount().' '.'$'}}</span></li>
                <li style="color: darkred">Thành tiền: <span style="color: deeppink">{{$totalcost.' '.'$'}}</span></li>
                {{Cart::destroy()}}
            </ul>


        </div>
    </section>
    <!--/#cart_items-->

    @endsection
</section>
