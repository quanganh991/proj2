@extends('welcome')
@section('order')
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h1 class="h2">Thông báo của bạn</h1>
                </div>
                <div class="col-md-5">
                    <ul class="breadcrumb d-flex justify-content-end">
                        <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                        <li class="breadcrumb-item">Thông Báo</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 style="color: red">
            Thông Báo Của Bạn
        </h2>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>Thời Gian</th>
                    <th>Nội dung</th>
                    <th>Xem chi tiết</th>
                    <th>Đánh dấu đã đọc</th>
                </tr>
                </thead>
                <tbody>

                @foreach($allUserNotification as $eachUserNotification)
                    <tr>
                        @if($eachUserNotification->isread == 0)
                        <td style="color: red; font-weight: bold">{{$eachUserNotification->datenoti }}</td>
                        <td style="color: red; font-weight: bold">{{$eachUserNotification->context}}</td>
                        <td>
                            <a href="{{URL::to('/user-view-order-detail/'.$eachUserNotification->id_oder)}}">{{$eachUserNotification->id_oder}}
                            </a>
                        </td>
                        <td><a href="{{URL::to('/user-mark-notification-as-read/'.$eachUserNotification->id_notification)}}">Đánh dấu đã đọc</a></td>
                        @elseif($eachUserNotification->isread == 1)
                            <td>{{$eachUserNotification->datenoti }}</td>
                            <td>{{$eachUserNotification->context}}</td>
                            <td>
                                <a href="{{URL::to('/user-view-order-detail/'.$eachUserNotification->id_oder)}}">{{$eachUserNotification->id_oder}}
                                </a>
                            </td>
                            <td></td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
