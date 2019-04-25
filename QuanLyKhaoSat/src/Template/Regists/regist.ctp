<?php echo $this->Html->css('HNam'); ?>
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
                <td><input type="email" style="background-color: #000055;color: white" name="email" class="form-control"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" style="background-color: #000055;color: white" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Fullname</th>
                <td><input type="text" style="background-color: #000055;color: white" name="fullname" class="form-control"></td>
            </tr>
            <tr >
                <th>Address</th>
                <td><input type="text" style="background-color: #000055;color: white" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>phone</th>
                <td><input type="text" style="background-color: #000055;color: white" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth</th>
                <td><input type="date" style="background-color: #000055;color: white" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th>Level</th>
                <td>
                    <select name="level" id="" class="form-control" style="background-color: #000055;color: white">
                        <option value="Member">Member</option>
                    </select>
                </td>
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
    <div>
        <a href="<?= SITE_URL ?>users/login">Quay Lại Trang "Đăng Nhập"</a>
    </div>
</fieldset>
<?php echo $this->Html->script('validate'); ?>
