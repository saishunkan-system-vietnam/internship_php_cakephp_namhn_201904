<fieldset class="col-md-8 col-md-offset-2" style="margin-top: 120px;border: 2px solid #222222">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        Edit Users
    </legend>
    <form action="<?= SITE_URL ?>users/edit/<?php echo $data->id ?>" id="formUsers" method="post">
        <table border="2" class="table"
               style="background-color: #222222;color: white;font-weight: bold;text-align: center">
            <tr style="height: 50px;line-height: 45px;">
                <th style="text-align: center">Email</th>
                <td><input value="<?php echo $data->email ?>"
                           type="email" name="email" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Password</th>
                <td><input value="<?php echo $data->password ?>"
                           type="password" name="password" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Fullname</th>
                <td><input value="<?php echo $data->fullname ?>"
                           type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Address</th>
                <td><input value="<?php echo $data->address ?>"
                           type="text" name="address" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">phone</th>
                <td><input value="<?php echo $data->phone ?>"
                           type="text" name="phone" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Birth</th>
                <td><input value="<?php echo $data->birth ?>"
                           type="date" name="birth" class="form-control"></td>
            </tr>
            <tr style="height: 50px;line-height: 45px">
                <th style="text-align: center">Level</th>
                <td><select name="level" class="form-control">
                        <?php if ($data->level == 'Admin') { ?>
                            <option value="<?php echo $data->level; ?>"><?php echo $data->level; ?></option>
                            <option value="Member">Member</option>
                        <?php } ?>
                        <?php if ($data->level == 'Member') { ?>
                            <option value="<?php echo $data->level; ?>"><?php echo $data->level; ?></option>
                            <option value="Admin">Manager</option>
                        <?php } ?>
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
