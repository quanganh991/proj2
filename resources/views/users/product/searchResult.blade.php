@extends('welcome')
@section('content')
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Branch của sản phẩm</th>
                    <th>Main của sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Hình Ảnh</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product as $productValue) {{--$product chứa tất cả các bản ghi đã truy vấn, $key chứa chỉ số bản ghi, $productValue chứa từng bản ghi một--}}

                <tr>
                    <td>
                        <?php
                        $prod = DB::table('product')->where('id_product', $productValue->id_product)->get()->first();
                        ?>
                        <a href="{{URL::to('/detail/'.$productValue->id_product) }}">{{$prod->name}}</a>
                    </td>
                    <td>
                        <?php
                        $bra = DB::table('category_branch')->where('id_category_branch', $prod->id_category_branch)->get()->first();
                        ?>
                        <a style="color: deepskyblue" href="{{URL::to('/product-result/'.$bra->id_category_branch) }}">
                            {{$bra->name}}
                        </a>
                    </td>
                    <td style="color: red"><?php
                        $cat = DB::table('category_main')->where('id_category_main', $bra->id_category_main)->get()->first();
                        ?>
                            <a style="color: darkorange" href="{{URL::to('/branch-result/'.$cat->id_category_main) }}">{{$cat->name}}</a>
                    </td>
                    <td>
                        <?php
                        $motasp = $productValue->description;
                        if (strlen($motasp) > 50){
                            $motasp  = substr($motasp,0,50)."...";
                        }
                        ?>
                        {{$motasp."."}}
                    </td>
                    <td>
                        <a href="{{URL::to('/detail/'.$productValue->id_product) }}">
                            <img height="100" width="100" src="{{ URL::to('/') }}/public/imgproduct/{{$productValue->image}}" class="img-fluid">
                        </a>
                    </td>
                    <td>{{ $productValue->amount }}</td>
                    <td style="color: blue">{{ $productValue->price }}</td>
                    <td>
                        @if($productValue->isactive == 1)
                            <p style="color: green"> Còn hàng</p>
                        @elseif($productValue->isactive == 0)
                            <p style="color: red"> Hết hàng</p>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
