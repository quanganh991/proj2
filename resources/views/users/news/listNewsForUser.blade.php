@extends('welcome')

@section('category_branch')
    <div id="content">
        <div class="container">
            <br>
            <h2 class=" text-center" style="color: blue">
                Trang tin tức
            </h2>
            <br>
            <div class="table-responsive">
                @foreach($listNews as $eachOfListNews)
                    <?php
                    $sp = DB::table('product')->where('id_product' ,$eachOfListNews->id_product)->get()->first();
                    ?>
                    <div>
                        <img width="50" height="50"
                             src="{{ URL::to('/') }}/public/imgproduct/{{$sp->image}}"
                             alt="" class="img-fluid">
                        <a href="{{URL::to('/detail-news-for-user/'.$eachOfListNews->id_news) }}">
                            <h3 style="color:red;">{{ $eachOfListNews->title }}</h3>
                        </a>
                        <label style="color: deeppink">({{$eachOfListNews->publish_date}})</label>
                    </div>
                    <hr><br>
                @endforeach

            </div>

        </div>
    </div>
@endsection
