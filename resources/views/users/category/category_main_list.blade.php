@extends('welcome')
@section('category_main')


    <div id="content">
        <div class="container">
            <section class="bar">
                @foreach($mainSearch as $mainSearchValue)

                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading">
                                <a href="{{URL::to('/branch-result/'.$mainSearchValue->id_category_main)}}">
                                    <h2>{{$mainSearchValue->name}}</h2>
                                </a>
                            </div>
                            <div>
                                <h5>{{$mainSearchValue->description}}</h5>
                            </div>
                        </div>
                    </div>

                @endforeach
            </section>
        </div>
    </div>
@endsection
