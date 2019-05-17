<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend>
        ADD Users
    </legend>
    <form action="<?= URL ?>users/add" id="formUsers" method="post">
        <table class="table table-hover">
            <tr>
                <th>Email</th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="email" name="email" class="form-control email"></td>
                <td style="border-bottom: 1px solid #DDDDDD">
                    <button class="btn btn-primary" type="button" onclick="checkUsers()">Kiểm tra</button></td>
            </tr>
            <tr>
                <th></th>
                <th style="font-weight: bold" class="dataShow"></th>
            </tr>
            <tr>
                <th>Password</th>
                <td colspan="2"><input value="<?php echo isset($result[1]) ? $result[1] : '' ?>"
                           type="password" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Fullname</th>
                <td colspan="2"><input value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                           type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="2"><input value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                           type="text" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td colspan="2"><input value="<?php echo isset($result[4]) ? $result[4] : '' ?>"
                           type="text" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth</th>
                <td colspan="2"><input value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                           type="date" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th>Level</th>
                <td colspan="2"><select name="level" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td colspan="2">
                    <button class="btn btn-primary" type="submit"><i class="far fa-thumbs-up"></i> Submit</button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/admins'); ?>
<script>
    function checkUsers() {
        email = $(".email").val();
        $.ajax({
            url: '<?= URL ?>users/check?email='+email,
            type: 'GET',
            success: function (res) {
                $('.dataShow').html(res);
                console.log(res);
            }
        });
    }
</script>
