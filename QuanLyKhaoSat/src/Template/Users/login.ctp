<?php echo $this->Html->css('HNam'); ?>
    <fieldset class="col-md-8 col-md-offset-2">
    <legend>
        Bạn vui lòng Đăng Nhập ^^!
    </legend>
    <form action="" method="post" id="formUsers">
        <table border="2" class="table">
            <tr>
                <th>Users Name</th>
                <td><input type="text" style="background-color: #000055;color: white" class="form-control"  name="email"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" style="background-color: #000055;color: white"  name="password" class="form-control"></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit">Đăng Nhập</button>
                    <button type="reset">Nhập Lại</button>
                </td>
            </tr>
        </table>
    </form>
    <div id="regist">
        <a href="<?= SITE_URL ?>regists/regist">Nếu bạn chưa có tài
                khoản vui lòng "Đăng Ký"</a>
    </div>
</fieldset>
<?php echo $this->Html->script('validate'); ?>