
@extends('admin.welcomeAdmin')
@section('all_main_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục các Main</h3>
                    </div>
            <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Form add new product -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Thêm mới Main</button>
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg-12" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body ">
                                            <section>
                                                <div >
                                                    <div class="row">
                                                        <!-- left column -->

                                                        <div class="col-md-12">
                                                        <!-- general form elements -->
                                                            <div class="card-primary">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Thêm mới Main</h3>
                                                                </div>
                                                        <!-- /.card-header -->
                                                        <!-- form start -->
                                                        <form action="{{URL::to('/save-main-category')}}" method="GET">
                                                            {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="main_name">Tên Main</label>
                                                                        <input type="text" class="form-control" name="main_name" id="main_name" placeholder="Main Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label>Mô tả</label>
                                                                            <input type="text" class="form-control" name="main_descr" id="main_descr" placeholder="Mô tả product">
                                                                    </div>


                                                                <!-- /.card-body -->

                                                                    <div class="card-footer">
                                                                    <button type="submit" name="add_main" class="btn btn-primary">Thêm</button>
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
                                    <th>ID Main</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allCategoryMain as $eachCategoryMain)
                                <tr>
                                    <td>{{ $eachCategoryMain->id_category_main }}</td>
                                    <td>
                                        <a style="color: darkorange" href="{{URL::to('/branch-result/'.$eachCategoryMain->id_category_main) }}">
                                            {{ $eachCategoryMain->name }}
                                        </a>

                                    </td>
                                    <td>{{ $eachCategoryMain->description }}</td>
                                    <td>
                                        <a href="{{URL::to('/edit-main-category/'.$eachCategoryMain->id_category_main)}}">Edit</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allCategoryMain->links() !!}
                            </div>
                        </div>
                    </div>
            <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
