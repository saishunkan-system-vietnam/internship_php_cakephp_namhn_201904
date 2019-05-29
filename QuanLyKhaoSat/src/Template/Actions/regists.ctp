<style>
    fieldset {
        margin-top: 40px;
    }

    legend {
        text-align: center;
        font-weight: bold;
    }

    th {
        text-align: center;
        height: 40px;
        font-size: 18px;
    }

    .form-control {
        height: 50px;
        font-size: 18px;
    }
</style>
<fieldset class="col-md-10 col-md-offset-1">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email Đã Tồn Tại, Xin Vui Lòng NHập Email Khác ^^!
        </div>
    <?php } ?>
    <?php if (isset($errorPass)) { ?>
        <div class="alert alert-danger">
            Mật Khẩu Nhập Lại Không Trùng Khớp ^^!
        </div>
    <?php } ?>
    <?php if (isset($errorBirth)) { ?>
        <div class="alert alert-danger">
            Ngày Sinh Nhập Đã Lỗi ^^!
        </div>
    <?php } ?>
    <legend>
        ADD Users
    </legend>
    <form action="" method="post" id="formRegisters">
        <table class="table table-hover table-bordered ">
            <tr>
                <th class="col-md-4">Tài Khoản</th>
                <td><input placeholder="Nhập tài khoản"
                           value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="email" name="email" id="email" class="form-control email"></td>
            </tr>
            <tr id="show">
                <th></th>
                <th style="font-weight: bold" class="dataShow"></th>
            </tr>
            <tr>
                <th>Mật Khẩu</th>
                <td><input placeholder="Nhập mật khẩu"
                           value="<?php echo isset($result[1]) ? $result[1] : '' ?>"
                           type="password" id="pass1" name="password1" class="form-control"></td>
            </tr>
            <tr id="pass2">
                <th>Nhập Lại Mật Khẩu</th>
                <td><input placeholder="Nhập lại mật khẩu"
                           value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                           type="password" name="password2" class="form-control"></td>
            </tr>
            <tr>
                <th>Họ và Tên</th>
                <td><input placeholder="Nhập họ và tên của bạn"
                           value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                           type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr>
                <th>Địa Chỉ</th>
                <td><input placeholder="Nhập địa chỉ"
                           value="<?php echo isset($result[4]) ? $result[4] : '' ?>"
                           type="text" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>Số Điện Thoại</th>
                <td><input placeholder="Nhập số điện thoại"
                           value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                           type="text" id="tel" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Ngày/Tháng/Năm Sinh</th>
                <td><input placeholder="Nhập Ngày / Tháng / Năm Sinh"
                           value="<?php echo isset($result[6]) ? $result[6] : '' ?>"
                           type="date" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th>Câu Hỏi Bí Mật</th>
                <td><select name="secret_q" class="form-control">
                        <?php if (isset($result[7]) && $result[7] == "Trường Đại Học Của Bạn Là Gì ?" || !isset($result[7])) { ?>
                            <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                            <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?</option>
                            <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                        <?php }
                        if (isset($result[7]) && $result[7] == "Tác Phẩm Bạn Thích Nhất Là Gì ?") { ?>
                            <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?</option>
                            <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                            <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                        <?php }
                        if (isset($result[7]) && $result[7] == "Môn Học Bạn Thích Nhất Là Gì ?") { ?>
                            <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                            <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?</option>
                            <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <th>Câu Trả Lời</th>
                <td><input placeholder="Nhập câu trả lời cho câu hỏi bí mật"
                           value="<?php echo isset($result[8]) ? $result[8] : '' ?>"
                           type="text" name="secret_a" class="form-control"></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button class="btn btn-primary" id="submit" type="submit"><i class="far fa-thumbs-up"></i> Submit
                    </button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/register'); ?>
<script>
    $(document).ready(function () {
        $("#pass2").hide();
        $("#show").hide();
        $("#pass1").keyup(function () {
            if ($("#pass1").val() != '') {
                $("#pass2").show();
            } else {
                $("#pass2").hide();
            }
        });
        if ($("#pass1").val() != '') {
            $("#pass2").show();
        }
        //====== Validate số điên thoại
        $('#tel').mouseout(function () {
            var regExp = /[^0-9]/;
            if ($('#tel').val().match(regExp)) {
                swal("Số điện thoại bạn nhập không hợp lệ ^^!");
            }
        });
    })
</script>
<script>
    $(document).ready(function () {
        $("#formRegisters").validate({
            rules: {
                email: "required",
                password1: "required",
                password2: "required",
                address: "required",
                phone: "required",
                birth: "required",
                secret_a: "required",
                fullname: {
                    required: true,
                }
            },
            messages: {
                email: "Bạn quên nhập email rồi ^^!",
                password1: "Bạn quên nhập password rồi ^^!",
                password2: "Bạn quên nhập password rồi ^^!",
                address: "Bạn quên nhập địa chỉ kìa ^^!",
                phone: "Hãy cho tôi biết số điện thoại của bạn ^^!",
                birth: "Ngày tháng năm sinh của bạn là chi ? ^^",
                secret_a: "Hãy nhập câu trả lời của bạn ^^",
                fullname: {
                    required: "Bạn ơi Nhập họ tên đầy đủ của mình đi",
                }
            }
        });
    });
</script>