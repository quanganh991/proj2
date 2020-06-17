@extends('admin.welcomeAdmin')
@section('all_branch_category')

    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 id="users" class="card-title">Quản lý người dùng</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID Người dùng</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Credit</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allUser as $eachUser)
                                <tr>
                                    <td>{{ $eachUser->id_customer }}</td>
                                    <td style="color: red">{{ $eachUser->name }}</td>
                                    <td>{{ $eachUser->email }}</td>
                                    <td style="color: coral">{{ $eachUser->phone_number }}</td>
                                    <td>{{ $eachUser->address }}</td>
                                    <td style="color: mediumpurple">{{ $eachUser->credit }}</td>
                                    <td>
                                        <?php
                                        if($eachUser->status == 0){ //bị block
                                        ?>
                                        <p style="color: red">Bị Khóa</p>
                                        <a href="{{URL::to('/unblock-user/'.$eachUser->id_customer)}}">Mở Khóa tài khoản</a>
                                        <?php
                                        }else{ //if ($eachUser->_status==1) // active
                                        ?>
                                        <p style="color: green">Đang hoạt động</p>
                                        <a href="{{URL::to('/block-user/'.$eachUser->id_customer)}}">Khóa tài khoản</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
