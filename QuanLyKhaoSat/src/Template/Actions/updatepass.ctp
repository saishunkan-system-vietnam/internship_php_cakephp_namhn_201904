<?php if (isset($check->token) && $check->token != null) { ?>
    <form action="" method="post" style="margin-top: 40px;">
        <fieldset class="col-md-8 col-md-offset-2">
            <legend style="font-weight: bold;color: black;text-align: center">[ Mật Khẩu Mới ]</legend>
            <table class="table table-hover table-bordered">
                <?php if (!empty($passwrod_error)) { ?>
                    <tr>
                        <th colspan="2" style="text-align: center">Mật Khẩu Nhập Lại Không Khớp</th>
                    </tr>
                <?php } ?>
                <?php if (!empty($success)) { ?>
                    <tr>
                        <th colspan="2">Mật Khẩu Đã Được Thay Đổi Thành Công</th>
                    </tr>
                <?php } ?>
                <tr>
                    <th>Nhập Mật Khẩu Mới</th>
                    <th><input type="password" class="form-control" style="color: black" name="password1"></th>
                </tr>
                <tr>
                    <th>Nhập Lại Mật Khẩu</th>
                    <th><input type="password" class="form-control" style="color: black" name="password2"></th>
                </tr>
                <tr>
                    <th></th>
                    <th>
                        <button style="width: 110px;height: 45px;font-size: 19px;background-color: #333333;color: white"
                                type="submit" id="success">Đồng ý
                        </button>
                    </th>
                </tr>
            </table>
        </fieldset>
    </form>
<?php } else { ?>
    <h3 style="margin-top: 35px;width: 600px;text-align: center;font-weight: bold;border-bottom: 1px solid #DDDDDD">Mật
        Khẩu Của Bạn Đã Được Thay Đổi Thành Công</h3>
<?php } ?>
