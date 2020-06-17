@extends('welcome')

@section('category_branch')
    <?php
    $sp = DB::table('product')->where('id_product', $detailNews->id_product)->get()->first();
    ?>
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <a href="{{URL::to('/product-result/'.$sp->id_category_branch)}}">
                        <h1 style="color: darkorange" class="h2">{{$sp->name}}</h1>
                    </a>

                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{URL::to('/list-news-for-user')}}">Tất cả tin tức</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="table-responsive">
                <br>
                <h1 style="color: red">{{ $detailNews->title }}</h1>
                <h5 style="color: darkorange">Ngày cập nhật: {{ $detailNews->publish_date }} - Tác
                    giả: {{ $detailNews->name }}</h5>
                <br>
                <img width="400" height="400"
                     src="{{ URL::to('/') }}/public/imgproduct/{{$sp->image}}"
                     alt="" class="img-fluid">
                <br>
                <hr>
                <p style="color: #0c5460">{{ $detailNews->context }}</p>
                <hr>
            </div>

        </div>
    </div>
@endsection
