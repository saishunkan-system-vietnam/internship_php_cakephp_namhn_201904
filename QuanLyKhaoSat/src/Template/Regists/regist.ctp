<?php echo $this->Html->css('haizzz'); ?>
<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($data->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend>
        Đăng kí làm thành viên
    </legend>
    <form action="" method="post" id="formUsers">
        <table border="2" class="table">
            <tr>
                <th>Email</th>
                <td><input type="email" class="form-control"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Fullname</th>
                <td><input type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input type="text" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>phone</th>
                <td><input type="text" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth</th>
                <td><input type="date" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th>Level</th>
                <td>
                    <select name="level" id="" class="form-control">
                        <option value="Member">Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button class="sub" type="submit">Đăng Ký</button>
                </td>
            </tr>
        </table>
        <div style="margin-bottom: 20px;">
            <a style="text-decoration: none;" href="<?= SITE_URL ?>users/login">Quay Lại Trang Đăng Nhập</a>
        </div>
    </form>
</fieldset>
<?php echo $this->Html->script('validate'); ?>
