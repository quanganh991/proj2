@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý tin tức</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Form add new News -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm tin tức mới
                        </button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div>
                                                <div class="row">
                                                    <!-- left column -->

                                                    <div class="col-md-12">
                                                        <!-- general form elements -->
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm tin tức mới</h3>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <!-- form start -->
                                                            <form action="{{URL::to('/save-news')}}" method="GET">
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Tiêu đề bài viết</label>
                                                                        <input type="text" name="title"
                                                                               class="form-control" id="title"
                                                                               placeholder="tiêu đề của news">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Nội dung </label>
                                                                        <textarea type="text" name="context"
                                                                                  class="form-control" id="context"
                                                                                  placeholder="Nội dung bài viết"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Sản phẩm</label>
                                                                        <?php
                                                                        $sp = DB::table('product')->get();
                                                                        ?>
                                                                        <select  class="form-control input-sm m-bot15" name="id_product" id="id_product" >
                                                                            @foreach($sp as $indexsp)
                                                                                <option
                                                                                    value="{{$indexsp->id_product}}">{{$indexsp->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Hiển thị</label>
                                                                        <select name="status"
                                                                                class="form-control input-sm m-bot15">
                                                                            <option value="0">Ẩn</option>
                                                                            <option value="1">Hiển thị</option>
                                                                        </select>
                                                                    </div>
                                                                    <!-- /.card-body -->

                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_branch"
                                                                                class="btn btn-primary">Lưu
                                                                        </button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end form -->
                        <br></br>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID bài viết</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Tác giả</th>
                                <th>Trạng thái</th>
                                <th>Chỉnh sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allNews as $eachOfAllNews)
                                <tr>
                                    <td>{{ $eachOfAllNews->id_news }}</td>
                                    <td style="color: red">{{ $eachOfAllNews->title }}</td>
                                    <td style="color: green">{{ $eachOfAllNews->context }}</td>
                                    <td>{{ $eachOfAllNews->publish_date }}</td>
                                    <td>
                                        <?php
                                        $sp = DB::table('product')->where('id_product',$eachOfAllNews->id_product)->get()->first();
                                        ?>
                                        <a href="{{URL::to('/detail/'.$sp->id_product) }}">{{$sp->name}}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/detail/'.$sp->id_product) }}">
                                            <img width="100" height="100" src="{{ URL::to('/') }}/public/imgproduct/{{$sp->image}}" class="img-fluid">
                                        </a>
                                    </td>
                                    <td style="color: deeppink">
                                        <?php
                                        $author = DB::table('admininfo')->where('id_admin',$eachOfAllNews->id_admin)->get()->first();
                                        ?>
                                        {{$author->name}}
                                    </td>
                                    <td>
                                        <?php
                                        if($eachOfAllNews->status == 1){
                                        ?>
                                        <p></p>
                                            <p style="color: green">Đang được hiển thị</p>
                                        <a href="{{URL::to('/unactive-news/'.$eachOfAllNews->id_news)}}">Ẩn bài viết</a>
                                        <?php
                                        }else{ //if ($eachOfAllNews->status==0)
                                        ?>
                                            <p style="color: red">Bài viết bị ẩn</p>
                                        <a href="{{URL::to('/active-news/'.$eachOfAllNews->id_news)}}">Hiển thị bài viết</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-news/'.$eachOfAllNews->id_news)}}">Sửa</a>
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
    </section>
@endsection
