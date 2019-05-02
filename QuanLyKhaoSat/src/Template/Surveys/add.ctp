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
            <div class="col-md-8"><input style="color: white" type="text" name="name" class="form-control"></div>
        </div>
        <div class="row">
            <div class="col-md-4">Trạng Thái Đăng Nhập</div>
            <div class="col-md-8">
                <label>
                    <input type="checkbox" name="login_status" class="filled-in" checked="checked"/>
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <span>Ngày Bắt Đầu Khảo Sát :</span>
            </div>
            <div class="col-md-8">
                <input type="date" style="color: white" class="form-control" name="start_time">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Ngày Kết Thúc Khảo Sát :
            </div>
            <div class="col-md-8">
                <input type="date" style="color: white" class="form-control" name="end_time">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Số Khảo Sát Tối Đa :
            </div>
            <div class="col-md-8">
                <input style="color:white;"  type="number" name="maximum" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Thời Gian Khởi Tạo Khảo Sát :
            </div>
            <div class="col-md-8">
                <input style="color:white;"  type="date" name="created" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <button class="button" type="submit">Submit</button>
                <button class="button" type="reset">Reset</button>
            </div>
        </div>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/surveys'); ?>