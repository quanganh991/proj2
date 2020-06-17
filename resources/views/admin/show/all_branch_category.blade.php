@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý danh mục Branch</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm branch mới
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
                                                                <h3 class="card-title">Thêm branch mới</h3>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <!-- form start -->
                                                            <form action="{{URL::to('/save-branch-category')}}"
                                                                  method="GET">
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="Id_category">category</label>
                                                                        <?php
                                                                        $cat = DB::table('category_main')->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_category_main"
                                                                                id="id_category_main">
                                                                            @foreach($cat as $indexcat)
                                                                                <option
                                                                                    value="{{$indexcat->id_category_main}}">{{$indexcat->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Tên branch</label>
                                                                        <input type="text" class="form-control"
                                                                               name="branch_name" id="branch_name"
                                                                               placeholder="Branch name">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Giới thiệu branch</label>
                                                                        <textarea style="resize: none" rows="8"
                                                                                  class="form-control"
                                                                                  name="branch_descr"
                                                                                  id="branch_descr"
                                                                                  placeholder="Description branch"></textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Hình ảnh</label>
                                                                        <input type="file" name="branch_logo"
                                                                               class="form-control" id="branch_logo">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Trạng thái</label>
                                                                        <select name="branch_status"
                                                                                class="form-control input-sm m-bot15">
                                                                            <option value="0">Còn kinh doanh</option>
                                                                            <option value="1">Ngừng kinh doanh</option>
                                                                        </select>
                                                                    </div>
                                                                    <!-- /.card-body -->

                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_branch"
                                                                                class="btn btn-primary">Thêm
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
                        <!-- alert Edit -->
                        @if(isset($checkedit))
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    @if($checkedit == true)
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            <strong id="alert-header">{{$alert}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                    @endif
                    <!-- end alertEdit -->

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 18%">ID Branch</th>
                                <th style="width: 20%">Tên Main tương ứng</th>
                                <th>Tên Branch</th>
                                <th>Hình Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Chỉnh sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allCategoryBranch  as $eachCategoryBranch)
                                <?php
                                $categoryMainOnly = DB::table('category_main')->where('id_category_main', $eachCategoryBranch->id_category_main)->get()->first();    //chứa 1 bản ghi trong bảng main
                                ?>
                                <tr>
                                    <td class="text-center">{{ $eachCategoryBranch->id_category_branch }}</td>
                                    <td class="text-center">
                                        <a style="color: red"
                                           href="{{URL::to('/edit-main-category/'.$categoryMainOnly->id_category_main) }}">
                                            {{$categoryMainOnly->name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/product-result/'.$eachCategoryBranch->id_category_branch) }}">
                                            {{ $eachCategoryBranch->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/product-result/'.$eachCategoryBranch->id_category_branch) }}">
                                            <img width="100" height="100"
                                                 src="{{ URL::to('/') }}/public/imgbranch/{{$eachCategoryBranch->image}}"
                                                 alt=""
                                                 class="img-fluid">
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        if($eachCategoryBranch->status == 1){
                                        ?>
                                        <p style="color: green">Đang kinh doanh</p>
                                        <a href="{{URL::to('/unactive-branch-category/'.$eachCategoryBranch->id_category_branch)}}">Ngừng
                                            kinh doanh</a>
                                        <?php
                                        }else{ //if ($eachCategoryBranch->branch_status==0)
                                        ?>
                                        <p style="color: red">Đang ngừng kinh doanh</p>
                                        <a href="{{URL::to('/active-branch-category/'.$eachCategoryBranch->id_category_branch)}}">Kinh
                                            doanh</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-branch-category/'.$eachCategoryBranch->id_category_branch)}}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allCategoryBranch->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
