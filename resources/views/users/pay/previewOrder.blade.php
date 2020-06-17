@extends('welcome')
@section('noteDetail')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="breadcrumbs">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item">Chọn nơi nhận hàng và phương thức thanh toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{URL::to('/pay')}}">
            <div class="table-responsive">
                <br>
                <div style="color: blueviolet">
                    Tỉnh thành:
                    @if(!Session::get('idprovince'))
                        <?php
                        $prov = DB::table('province')->get();   //lấy địa chỉ nhận hàng
                        ?>
                        <select class="form-control col-lg-6" name="shipping_province" id="shipping_province">
                            @foreach($prov as $indexprov)
                                <option value="{{$indexprov->id_province}}">
                                    {{$indexprov->name}}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <?php
                        $prov = DB::table('province')->where('id_province', Session::get('idprovince'))->get()->first();
                        ?>
                        <label style="color: brown">
                            <input class="form-control col-lg-6" type="hidden" readonly name="shipping_province"
                                   id="shipping_province" value="{{Session::get('idprovince')}}">
                            {{$prov->name}}
                        </label>
                    @endif
                    <br>
                </div>
                <table class="table">
                    <thead>
                    <tr>{{--cả 7 mục này cùng với ID tỉnh thành sẽ được chuyển sang hàm noteDetail trong PayController--}}
                    <th>Image</th>  {{--5 mục này sẽ được lấy từ trong Cart--}}
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Giảm giá</th>
                    <th>Tạm tính</th>
                    <th>Giá bìa (chưa VAT)</th> {{--2 mục này sẽ được truyền sang noteDetail--}}
                    <th>Đối tác giao hàng</th>  {{--2 mục này sẽ được truyền sang noteDetail--}}
                    </tr>
                    </thead>
                    <?php $content = Cart::content();
                    $i = 0;
                    ?>
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
                                <a href="{{URL::to('/detail/'.$produc->id_product)}}">
                                    {{$eachContentItem->name}}
                                </a>
                            </td>
                            <td>{{$eachContentItem->qty}}</td>
                            <td style="color: #fd7605">{{'$'.number_format($eachContentItem->price)}}</td>
                            <td></td>
                            <td style="color: red">{{'$'.number_format($eachContentItem->price * $eachContentItem->qty)}}</td>
                            <td style="color: gold">
                                <input readonly class="form-control form-control-sm" name="subprice[{{$i}}]" id="subprice[{{$i}}]" value="{{$produc->price * 0.9}}">
                            </td>
                            <td>
                                <select class="form-control form-control-sm" id="partner_delivery[{{$i}}]"
                                        name="partner_delivery[{{$i}}]" style="float: left;">
                                    <?php
                                    $delivery = DB::table('partner_delivery')->get();
                                    ?>
                                    @foreach($delivery as $eachOfDelivery)
                                        <option value="{{$eachOfDelivery->id_partner_delivery}}">
                                            {{$eachOfDelivery->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                    @endforeach
                </table>

            </div>
            <br>
            <div style="text-align:center;">
                @if(count($content) > 0)
                    <input type="submit" value="Tiếp tục" name="send_order_place" class="btn btn-primary btn-sm">
                @endif
            </div>
            <br>
        </form>
    </div>
@endsection
