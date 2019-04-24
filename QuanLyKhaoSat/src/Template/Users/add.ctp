<fieldset class="col-md-8 col-md-offset-2" style="margin-top: 120px;border: 2px solid #222222">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        ADD Users
    </legend>
    <form action="<?= SITE_URL ?>users/add" id="formUsers" method="post">
        <table border="2" class="table"
               style="background-color: #222222;color: white;font-weight: bold;text-align: center">
            <tr style="height: 50px;line-height: 45px;">
                <th style="text-align: center">Email</th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="email" name="email" style="color: white" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Password</th>
                <td><input value="<?php echo isset($result[1]) ? $result[1] : '' ?>"
                           type="password" name="password" style="color: white" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Fullname</th>
                <td><input value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                           type="text" name="fullname" style="color: white" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Address</th>
                <td><input value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                           type="text" name="address" style="color: white" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">phone</th>
                <td><input value="<?php echo isset($result[4]) ? $result[4] : '' ?>"
                           type="text" name="phone" style="color: white" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Birth</th>
                <td><input value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                           type="date" name="birth" style="color: white" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Level</th>
                <td><select name="level" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input style="background-color: #222222;border: 2px solid white;color: white" type="submit"
                           name="submit"
                           value="Submit" class="btn">
                    <input style="background-color: #222222;border: 2px solid white;color: white" type="reset"
                           value="Reset"
                           class="btn">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate'); ?>
