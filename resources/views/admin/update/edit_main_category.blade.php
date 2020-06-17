@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Main Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-main')}}" method="GET">
                            <input type="hidden" name="id_category_main"
                                   value="{{$edit_main_category->id_category_main}}">

                            <div class="form-group">
                                <label>Tên main</label>
                                <input type="text" name="main_name" class="form-control" id="main_name"
                                       value="{{$edit_main_category->name}}">
                            </div>

                            <div class="form-group">
                                <label>Mô tả main</label>
                                <textarea rows="8" class="form-control" name="main_descr"
                                          id="main_descr">{{$edit_main_category->description}}</textarea>
                            </div>


                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa main</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
