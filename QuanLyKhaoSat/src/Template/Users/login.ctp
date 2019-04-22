<fieldset class="col-md-8 col-md-offset-2" style="margin-top: 120px;border: 2px solid #222222">
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        Bạn vui lòng Đăng Nhập ^^!
    </legend>
    <form action="" method="post" id="formUsers">
        <table border="2" class="table"
               style="background-color: #222222;color: white;font-weight: bold;text-align: center">
            <tr>
                <th style="text-align: center">Users Name</th>
                <td><input type="text" name="email" class="form-control"></td>
            </tr>
            <tr>
                <th style="text-align: center">Password</th>
                <td><input type="password" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input style="background-color: #222222;border: 2px solid white;color: white;height: 35px;border-radius: 5px;"
                           type="submit" value="Đăng Nhập">
                    <input style="background-color: #222222;border: 2px solid white;color: white;height: 35px;border-radius: 5px;"
                           type="reset" value="Nhập Lại">
                </td>
            </tr>
        </table>
    </form>
    <div style="background-color: #222222;height: 35px;width: 350px;text-align: center;line-height: 35px;border-radius: 7px;margin-bottom: 10px;margin-left: 240px;">
        <a style="color: white;font-weight: bold;" href="<?= SITE_URL ?>regists/regist">Nếu bạn chưa có tài
            khoản vui lòng "Đăng Ký"</a>
    </div>
</fieldset>
<?php echo $this->Html->script('validate'); ?>