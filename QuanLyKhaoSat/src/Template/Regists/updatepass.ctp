<form action="" method="post" style="margin-top: 80px;">
    <fieldset class="col-md-6 col-md-offset-3">
        <legend>Mật Khẩu Mới</legend>
        <table class="table table-hover table-bordered">
            <?php if (!empty($passwrod_error)) { ?>
                <tr>
                    <th colspan="2">Mật Khẩu Nhập Lại Không Chính Xác</th>
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
                <th style="background-color: white;border: none"></th>
                <th style="background-color: white;border: none">
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </th>
            </tr>
        </table>
    </fieldset>
</form>