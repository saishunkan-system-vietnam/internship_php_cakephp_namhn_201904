<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend>
        Edit Users
    </legend>
    <form action="<?= URL ?>users/edit/<?php echo $data->id ?>" id="formUsers" method="post">
        <table class="table table-hover">
            <tr>
                <th>Email</th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : $data->email ?>"
                           type="email" name="email" class="form-control"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input value="<?php echo isset($result[1]) ? $result[1] : $data->password ?>"
                           type="password" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Fullname</th>
                <td><input value="<?php echo isset($result[2]) ? $result[2] : $data->fullname ?>"
                           type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input value="<?php echo isset($result[3]) ? $result[3] : $data->address ?>"
                           type="text" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input value="<?php echo isset($result[4]) ? $result[4] : $data->phone ?>"
                           type="text" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth</th>
                <td><input value="<?php echo isset($result[5]) ? $result[5] : $data->birth ?>"
                           type="date" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th>Level</th>
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
                    <button class="button" type="submit">Submit</button>
                    <button class="button" type="reset">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/admins'); ?>