@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa branch</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-branch')}}" method="GET">
                            <input type="hidden" name="id_category_branch"
                                   value="{{$edit_branch_category->id_category_branch}}">
                            <div class="form-group">
                                <label>Tên của Main chứa branch</label>
{{--                                <input type="text" name="id_category_main" class="form-control" id="id_category_main"--}}
{{--                                       value="{{$edit_branch_category->id_category_main}}">--}}
                                <?php
                                $cat = DB::table('category_main')->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_category_main" id="id_category_main" >
                                    @foreach($cat as $indexcat)
                                        <option
                                            <?php if($indexcat->id_category_main ==  $edit_branch_category->id_category_main) echo "selected" ?>
                                            value="{{$indexcat->id_category_main}}">{{$indexcat->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên branch</label>
                                <input type="text" name="branch_name" class="form-control" id="branch_name"
                                       value="{{$edit_branch_category->name}}">
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea rows="8" class="form-control" name="branch_descr"
                                          id="branch_descr">{{$edit_branch_category->descriptionf}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="branch_logo" class="form-control" id="branch_logo"
                                       value="{{$edit_branch_category->image}}" required>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="branch_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ngừng kinh doanh</option>
                                    <option value="1">Còn hàng</option>
                                </select>
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Sửa branch</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
