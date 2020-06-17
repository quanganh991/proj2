@extends('welcome')

@section('category_branch')
    <div id="content">
        <div class="container">
            <section class="bar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>{{$descriptionMain->name}}</h2>
                        </div>
                        <p class="lead">{{$descriptionMain->description}}</p>
                    </div>
                </div>
                <div class="row portfolio text-center">
                    @foreach($branchSearch as $branchSearchValue)
                        <div class="col-md-4">
                            <div class="box-image">
                                <div>
                                    <h5 style="color: red">{{$branchSearchValue->name}}</h5>
                                </div>
                                <div class="image"><img width="300" height="300"
                                        src="{{ URL::to('/') }}/public/imgbranch/{{$branchSearchValue->image}}" alt=""
                                        class="img-fluid">
                                    <div class="overlay d-flex align-items-center justify-content-center">
                                        <div class="content">
                                            <div class="name">
                                                <h3><a href="portfolio-detail.html"
                                                       class="color-white">{{$branchSearchValue->name}}</a></h3>
                                            </div>
                                            <div class="text">
                                                <p class="buttons"><a
                                                        href="{{URL::to('/product-result/'.$branchSearchValue->id_category_branch) }}"
                                                        class="btn btn-template-outlined-white">Xem</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
