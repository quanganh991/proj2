
<header class="panel-heading">
    Thêm tin tức
</header>
<form action="{{URL::to('/save-news')}}" method="GET">
    {{ csrf_field() }}

    <div class="form-group">
        <label>Tiêu đề bài viết</label>
        <input type="text" name="title" class="form-control" id="title"
               placeholder="tiêu đề của news">
    </div>

    <div class="form-group">
        <label>Nội dung </label>
        <textarea type="text" name="context" class="form-control" id="context"
                  placeholder="Nội dung bài viết"></textarea>
    </div>

    <div class="form-group">
        <label>id product</label>
        <input type="text" name="id_product" class="form-control" placeholder="id product" id="id_product">
    </div>

    <div class="form-group">
        <label>Hiển thị</label>
        <select name="status" class="form-control input-sm m-bot15">
            <option value="0">Ẩn</option>
            <option value="1">Hiển thị</option>
        </select>
    </div>

    <button type="submit" name="add_news" class="btn btn-info">Thêm </button>
</form>
