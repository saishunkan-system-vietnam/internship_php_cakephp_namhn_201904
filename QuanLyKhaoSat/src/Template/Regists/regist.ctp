<fieldset class="col-md-8 col-md-offset-2" style="margin-top: 50px;border: 2px solid #222222">
    <?php if (isset($data->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        Đăng kí làm thành viên
    </legend>
    <form action="" method="post" id="formUsers">
        <table border="2" class="table"
               style="background-color: #222222;color: white;font-weight: bold;text-align: center">
            <tr style="height: 50px;line-height: 45px;">
                <th style="text-align: center">Email</th>
                <td><input type="email" name="email" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Password</th>
                <td><input type="password" name="password" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Fullname</th>
                <td><input type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Address</th>
                <td><input type="text" name="address" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">phone</th>
                <td><input type="text" name="phone" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Birth</th>
                <td><input type="date" name="birth" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Level</th>
                <td>
                    <select name="level" id="" class="form-control">
                        <option value="Member">Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input style="background-color: #222222;border: 2px solid white;color: white" type="submit"
                           value="Submit" class="btn">
                    <input style="background-color: #222222;border: 2px solid white;color: white" type="reset"
                           value="Reset"
                           class="btn">
                </td>
            </tr>
        </table>
    </form>
    <div style="background-color: #222222;height: 35px;width: 350px;text-align: center;line-height: 35px;border-radius: 7px;margin-bottom: 10px;margin-left: 240px;">
        <a style="color: white;font-weight: bold;" href="<?= SITE_URL ?>users/login">Quay Lại Trang "Đăng Nhập"</a>
    </div>
</fieldset>
<?php echo $this->Html->script('validate'); ?>
