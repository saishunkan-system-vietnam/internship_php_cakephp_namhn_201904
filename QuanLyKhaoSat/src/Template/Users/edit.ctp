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
                <th class="col-md-4">Email</th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : $data->email ?>"
                           type="email" name="email" onchange="checkEmail()" class="form-control email"></td>

                <td style="border-bottom: 1px solid #DDDDDD">
                    <button class="btn btn-primary check" type="button" onclick="checkUsers()">Kiểm tra</button></td>
            </tr>
            <tr>
                <th></th>
                <td class="dataShow"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td colspan="2"><input value="<?php echo isset($result[1]) ? $result[1] : $data->password ?>"
                           type="password" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Fullname</th>
                <td colspan="2"><input value="<?php echo isset($result[2]) ? $result[2] : $data->fullname ?>"
                           type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="2"><input value="<?php echo isset($result[3]) ? $result[3] : $data->address ?>"
                           type="text" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td colspan="2"><input value="<?php echo isset($result[4]) ? $result[4] : $data->phone ?>"
                           type="text" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth</th>
                <td colspan="2"><input value="<?php echo isset($result[5]) ? $result[5] : $data->birth ?>"
                           type="date" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th>Level</th>
                <td colspan="2"><select name="level" class="form-control">
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
                <th>Secret_Q</th>
                <td colspan="2">
                    <select name="secret_q" class="form-control">
                        <option value="<?php echo isset($result[7]) ? $result[7] : $data->secret_q ?>"><?php echo isset($result[7]) ? $result[7] : $data->secret_q ?></option>
                        <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                        <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                        <option value="Người Yêu Đầu Tiên Của Bạn Là Ai ?">Người Yêu Đầu Tiên Của Bạn Là Ai ?</option>
                        <option value="Vì Sao Bạn Học Lập Trình ?">Vì Sao Bạn Học Lập Trình ?</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Secret_A</th>
                <td colspan="2"><input class="form-control" name="secret_a" type="text" value="<?php echo isset($result[8]) ? $result[8] : $data->secret_a ?>"></td>
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
            url: '<?= URL ?>users/check?email='+email+'&id='+<?= $data->id ?>,
            type: 'GET',
            success: function (res) {
                $('.dataShow').html(res);
                console.log(res);
            }
        });
    }
</script>

