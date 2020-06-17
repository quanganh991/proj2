@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa tin tức</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-news')}}" method="GET">
                            <input type="hidden" name="id_news" value="{{$edit_news->id_news}}">
                            <div class="form-group">
                                <label>tiêu đề bài viết</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       value="{{$edit_news->title}}">
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea onresize="true" rows="8" class="form-control" name="context"
                                          id="context">{{$edit_news->context}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <?php
                                $prod = DB::table('product')->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_product" id="id_product" >
                                    @foreach($prod as $indexprod)
                                        <option
                                            <?php if($indexprod->id_product == $edit_news ->id_product) echo "selected" ?>
                                            value="{{$indexprod->id_product}}">{{$indexprod->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                </select>
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa tin tức</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
