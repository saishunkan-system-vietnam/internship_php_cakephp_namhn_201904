<fieldset class="col-md-10 col-md-offset-1">
    <legend>Khởi Tạo Khảo Sát</legend>
    <form method="post" action="" id="formSurveys">
        <div class="row form-group">
            <div class="col-md-4">Danh mục khảo sát</div>
            <div class="col-md-8">
                <select class="form-control" name="catalog_id">
                    <?php foreach ($catalog as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">Tên Khảo Sát</div>
            <div class="col-md-8"><input type="text" name="name" class="form-control"></div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">Trạng Thái Đăng Nhập</div>
            <div class="col-md-8">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="danger">Check</button>
                    <input type="checkbox" class="hidden" name="login_status"/>
                </span>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <span>Ngày Bắt Đầu Khảo Sát :</span>
            </div>
            <div class="col-md-8">
                <input type="date"  class="form-control" name="start_time">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Ngày Kết Thúc Khảo Sát :
            </div>
            <div class="col-md-8">
                <input type="date"  class="form-control" name="end_time">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Số Khảo Sát Tối Đa :
            </div>
            <div class="col-md-8">
                <input ="color:white;" type="number" name="maximum" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <button class="btn btn-primary" type="submit"><i class="far fa-thumbs-up"></i> Submit</button>
                <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
            </div>
        </div>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/surveys'); ?>
