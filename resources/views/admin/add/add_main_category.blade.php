
<header class="panel-heading">
    Thêm main sản phẩm
</header>
<?php   //notification, message,...
$message = Session::get('message');
if ($message) {
    echo '<span class="text-alert">' . $message . '</span>';
    Session::put('message', null);
}
?>
<form action="{{URL::to('/save-main-category')}}" method="GET">
    {{ csrf_field() }}

    <div class="form-group">
        <label>Tên main</label>
        <input type="text" name="main_name" class="form-control" id="main_name"
               placeholder="Tên main">
    </div>

    <div class="form-group">
        <label>Mô tả main</label>
        <textarea style="resize: none" rows="8" class="form-control" name="main_descr"
                  id="main_descr" placeholder="Mô tả main"></textarea>
    </div>

    <button type="submit" name="add_main" class="btn btn-info">Thêm main</button>
</form>
