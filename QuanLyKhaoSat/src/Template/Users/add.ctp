<fieldset class="col-md-8 col-md-offset-2" style="margin-top: 120px;border: 2px solid #222222">
    <?php if (isset($data->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        ADD Users
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
                        <option value="Admin">Admin</option>
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
</fieldset>
<?php echo $this->Html->script('validate'); ?>
