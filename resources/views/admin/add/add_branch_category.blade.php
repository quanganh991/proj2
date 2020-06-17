
            <header class="panel-heading">
                Thêm branch sản phẩm
            </header>
                    <form action="{{URL::to('/save-branch-category')}}" method="GET">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>ID category</label>
                            <input type="text" name="id_category_main" class="form-control" id="id_category_main"
                                   placeholder="ID của category">
                        </div>

                        <div class="form-group">
                            <label>Tên branch</label>
                            <input type="text" name="branch_name" class="form-control" id="branch_name"
                                   placeholder="Tên branch">
                        </div>

                        <div class="form-group">
                            <label>Mô tả branch</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="branch_descr"
                                      id="branch_descr" placeholder="Mô tả branch"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="branch_logo" class="form-control" id="branch_logo">
                        </div>

                        <div class="form-group">
                            <label>Hiển thị</label>
                            <select name="branch_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_branch" class="btn btn-info">Thêm branch</button>
                    </form>
