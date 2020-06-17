@extends('welcome')
@section('order')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <h1 class="h2">Thông tin cá nhân</h1>
            </div>
            <div class="col-md-5">
                <ul class="breadcrumb d-flex justify-content-end">
                    <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item"> Thay đổi thong tin cá nhân</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div>
        <h1 style="text-align: center; color: red">Thay đổi thông tin cá nhân</h1>
    </div>
    <div class="content">
        <form action="{{URL::to('/alter-user-information')}}" method="GET">
            <div class="row">
                <div id="checkout" class="col-lg-12">
                    <div class="box border-bottom-0">

                        <input class="form-control" type="hidden" value="{{$customerInformation->id_customer}}" name="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: orangered" for="firstname">Email</label>
                                    <input class="form-control" type="text" name="email" placeholder="Email" value="{{$customerInformation->email}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: orangered" for="firstname">Tên</label>
                                    <input class="form-control" type="text" name="name" placeholder="Name" value="{{$customerInformation->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: orangered" for="firstname">Địa chỉ</label>
                                    <input class="form-control" type="text" name="address" placeholder="Address" value="{{$customerInformation->address}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: orangered" for="firstname">Số điện thoại</label>
                                    <input class="form-control" type="text" name="phone_number" placeholder="Phone" value="{{$customerInformation->phone_number}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: orangered" for="firstname">Credit</label>
                                    <input class="form-control" type="text" name="credit" placeholder="Credit" value="{{$customerInformation->credit}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="color: orangered" for="firstname">Mật khẩu</label>
                                    <input class="form-control" type="text" name="password" placeholder="Number" value="{{$customerInformation->password}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="send_order_place" class="btn btn-primary btn-sm">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
