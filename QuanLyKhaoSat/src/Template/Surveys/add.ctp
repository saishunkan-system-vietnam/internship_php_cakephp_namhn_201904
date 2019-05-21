<style>
    .col-md-4 {
        text-align: center;
        font-weight: bold;
    }
</style>
<?php echo $this->Html->css('radio'); ?>
<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($error->name)) { ?>
        <div class="alert alert-danger">
            Khảo Sát đã tồn tại, xin vui lòng nhập Khảo Sát khác ^^! Nhớ nha :))
        </div>
    <?php } ?>
    <legend>Khởi Tạo Khảo Sát</legend>
    <form method="post" action="" id="formSurveys"  enctype="multipart/form-data">
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
            <div class="col-md-4">Ảnh Khảo Sát</div>
            <div class="col-md-8">
                <input type="file" name="img" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">Tên Khảo Sát</div>
            <div class="col-md-8"><input value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                        type="text" name="name" class="form-control"></div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">Trạng Thái Đăng Nhập</div>
            <div class="col-md-8">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="danger">Check</button>
                    <input value="<?php echo isset($result[4]) ? $result[4] : '' ?>"
                            type="checkbox" class="hidden" name="login_status"/>
                </span>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <span>Ngày Bắt Đầu Khảo Sát :</span>
            </div>
            <div class="col-md-8">
                <input value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                        type="date"  class="form-control" name="start_time">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Ngày Kết Thúc Khảo Sát :
            </div>
            <div class="col-md-8">
                <input value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                        type="date"  class="form-control" name="end_time">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                Số Khảo Sát Tối Đa :
            </div>
            <div class="col-md-8">
                <input value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                        type="number" name="maximum" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">Trạng Thái :</div>
            <div class="col-md-8" style="text-align: left">
                <label class="radio" style="float: left">Mở Khảo Sát
                    <input type="radio" checked  value="open" name="status">
                    <span class="checkmark"></span>
                </label>
                <label class="radio" style="float: left;margin-top: 10px;margin-left: 50px;">Đóng Khảo Sát
                    <input type="radio"  value="closed" name="status">
                    <span class="checkmark"></span>
                </label>
                <div style="clear: both"></div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">Hiển Thị :</div>
            <div class="col-md-8" style="text-align: left">
                <label class="radio" style="float: left">Hiển Thị
                    <input type="radio" checked  value="1" name="hot">
                    <span class="checkmark"></span>
                </label>
                <label class="radio" style="float: left;margin-top: 10px;margin-left: 85px;">Không Hiển Thị
                    <input type="radio"  value="0" name="hot">
                    <span class="checkmark"></span>
                </label>
                <div style="clear: both"></div>
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
