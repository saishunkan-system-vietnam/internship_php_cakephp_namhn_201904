<?php echo $this->Html->css('HNam'); ?>
<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend>
        ADD Users
    </legend>
    <form action="<?= SITE_URL ?>users/add" id="formUsers" method="post">
        <table border="2" class="table">
            <tr>
                <th>Email</th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="email" name="email" class="form-control"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input value="<?php echo isset($result[1]) ? $result[1] : '' ?>"
                           type="password" name="password"  class="form-control"></td>
            </tr>
            <tr>
                <th>Fullname</th>
                <td><input value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                           type="text" name="fullname"  class="form-control"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><input value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                           type="text" name="address"  class="form-control"></td>
            </tr>
            <tr>
                <th>phone</th>
                <td><input value="<?php echo isset($result[4]) ? $result[4] : '' ?>"
                           type="text" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth</th>
                <td><input value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                           type="date" name="birth" style="color: white" class="form-control"></td>
            </tr>
            <tr>
                <th>Level</th>
                <td><select name="level" class="form-control" style="background-color: #000055;color: white">
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit"
                           value="Submit"
                           class="btn">
                    <input type="reset"
                           value="Reset"
                           class="btn">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate'); ?>
