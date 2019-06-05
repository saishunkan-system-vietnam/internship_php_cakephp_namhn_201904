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
    jQuery.validator.addMethod("tel", function (value, element) {
        // Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
        return this.optional(element) || /^[0-9]/.test(value);
    }, 'Số điện thoại nhập chưa chính xác');
    jQuery.validator.addMethod("pass", function (value, element) {
        // Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
        return this.optional(element) || /^(?=.{5,})(?=.*[a-z]+)(?=.*\d+)(?=.*[A-Z]+)(?=.*[^\w])[ -~]+$/.test(value);
    }, "Mật khẩu yêu cầu : 1 chữ số + 1 chữ viết hoa + 1 chữ viết thường + 1 ký tự đặc biệt");
    $(document).ready(function () {
        $("#formRegisters").validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 20,
                },
                password1: {
                    required:true,
                    pass : true,
                },
                password2: "required",
                address: "required",
                phone: {
                    required: true,
                    tel: true,
                    number: true,
                    minlength: 8,
                    maxlength: 15,
                },
                birth: "required",
                secret_q: "required",
                secret_a: "required",
                fullname: {
                    required: true,
                    minlength: 5,
                    maxlength:20,
                }
            },
            messages: {
                email: {
                    required : "Bạn vui lòng nhập Email ",
                    maxlength : "Email độ dài tối đa 20 ký tự",
                },
                password1: {
                    required : "Bạn quên nhập mật khẩu rồi",
                    pass: "Mật khẩu yêu cầu : 1 chữ số + 1 chữ viết hoa + 1 chữ viết thường + 1 ký tự đặc biệt",
                },
                password2: "Bạn quên nhập lại password rồi ^^!",
                address: "Bạn quên nhập địa chỉ kìa ^^!",
                phone: {
                    required: "Hãy cho tôi biết số điện thoại của bạn ^^!",
                    tel: "Số điện thoại nhập chưa chính xác",
                    number: "Số điện thoại nhập chưa chính xác",
                    minlength: "Số điện thoại cần ít nhất 8 số",
                    maxlength: "Số điện thoại nhiều nhất 15 số",
                },
                birth: "Ngày tháng năm sinh của bạn là chi ? ^^",
                secret_q: "Hãy chọn câu hỏi để tăng tính bảo mật",
                secret_a: "Bạn quên trả lời câu hỏi kìa ^^",
                fullname: {
                    required: "Bạn ơi Nhập họ tên đầy đủ của mình đi",
                    minlength: "Họ tên của bạn có vẻ hơi ngắn rồi ^^! ?",
                    maxlength: "Họ tên phải nhỏ hơn 20 ký tự",
                }
            }
        });
    });
</script>