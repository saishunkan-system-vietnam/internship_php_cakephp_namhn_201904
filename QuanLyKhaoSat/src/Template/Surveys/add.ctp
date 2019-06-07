<style>
    th {
        text-align: left;
    }
</style>
<?php echo $this->Html->css('radio'); ?>
<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($error->name)) { ?>
        <div class="alert alert-danger">
            Khảo Sát đã tồn tại, xin vui lòng nhập Khảo Sát khác ^^! Nhớ nha :))
        </div>
    <?php } ?>
    <?php if (isset($errorTime)) { ?>
        <div class="alert alert-danger">
            Thời gian bạn nhập đã lỗi .
        </div>
    <?php } ?>
    <?php if (isset($errorImages)) { ?>
        <div class="alert alert-danger">
            File bạn tải lên không phải là ảnh ^^!
        </div>
    <?php } ?>
    <legend>Khởi Tạo Khảo Sát</legend>
    <form method="post" action="<?= URL ?>surveys/add/<?php echo isset($id) ? $id : '' ?>" id="Surveys"
          enctype="multipart/form-data">
        <table class="table  table-bordered">
            <?php if (isset($catalogID)) { ?>
                <tr>
                    <th>Danh mục khảo sát</th>
                    <th><?php echo $catalogID->name; ?></th>
                </tr>
            <?php } else { ?>
                <tr>
                    <th>Danh mục khảo sát</th>
                    <th>
                        <select class="form-control" name="catalog_id">
                            <?php foreach ($catalog as $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                            <?php } ?>
                        </select>
                    </th>
                </tr>
            <?php } ?>
            <tr>
                <th>Ảnh Khảo Sát</th>
                <th>
                    <input type="file" accept="image/*" name="img" id="i_file" style="display: none">
                    <button class="fileImage" type="button" style="background-color: darkred;border-radius: 7px; ;color: white;height: 40px;width: 110px;">Chọn Ảnh</button>
                    <input type="text" disabled name="img" id="image" value="" style="border-radius: 7px;border: none;height: 38px;width: 60%;background-color: white">
                    <p id="checkImage" style="color: red;display: none">File bạn chọn không phải là Ảnh</p>
                </th>
                <script>
                    $(document).on("click", ".fileImage", function() {
                        $("#i_file").trigger("click");
                    });
                    $('input[type="file"]').change(function(e) {
                        if (e.target.files[0] != undefined) {
                            let fileName = e.target.files[0].name;
                            $('#image').val(fileName);
                        }
                    });
                </script>
            </tr>
            <tr>
                <th>Tên Khảo Sát <span style="color: red">( * )</span></th>
                <th><input placeholder="Nhập tên khảo sát"
                           required value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="text" name="name" class="form-control"></th>
            </tr>
            <tr>
                <th>Trạng Thái Đăng Nhập</th>
                <th>
                     <span class="button-checkbox">
                            <button type="button" class="btn" data-color="danger">Login</button>
                            <input type="checkbox" <?php echo isset($result[4]) && $result[4] == 'on' ? "checked" : '' ?> class="hidden"
                                   name="login_status"/>
                     </span>
                </th>
            </tr>
            <tr>
                <th>
                    <span>Ngày Bắt Đầu Khảo Sát :</span>
                </th>
                <th>
                    <input value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                           type="date" class="form-control" name="start_time">
                </th>
            </tr>
            <tr>
                <th>
                    Ngày Kết Thúc Khảo Sát :
                </th>
                <th>
                    <input value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                           type="date" class="form-control" name="end_time">
                </th>
            </tr>
            <tr>
                <th>
                    Số Khảo Sát Tối Đa :
                </th>
                <th>
                    <input placeholder="Nhập số khảo sát tối đa"
                           value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                           type="number" name="maximum" class="form-control">
                </th>
            </tr>
            <tr>
                <th>Trạng Thái :</th>
                <th style="text-align: left">
                    <label class="radio" style="float: left">Mở Khảo Sát
                        <input type="radio" checked value="open" name="status">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio" style="float: left;margin-top: 10px;margin-left: 50px;">Đóng Khảo Sát
                        <input type="radio" value="closed" name="status">
                        <span class="checkmark"></span>
                    </label>
                    <div style="clear: both"></div>
                </th>
            </tr>
            <tr>
                <th>Hiển Thị :</th>
                <th style="text-align: left">
                    <label class="radio" style="float: left">Hiển Thị
                        <input type="radio" checked value="1" name="hot">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio" style="float: left;margin-top: 10px;margin-left: 85px;">Không Hiển Thị
                        <input type="radio" value="0" name="hot">
                        <span class="checkmark"></span>
                    </label>
                    <div style="clear: both"></div>
                </th>
            </tr>
            <tr>
                <th></th>
                <th>
                    <button class="btn btn-primary" id="i_submit" type="submit"><i class="far fa-thumbs-up"></i> Submit
                    </button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                </th>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/Surveys/add_edit'); ?>