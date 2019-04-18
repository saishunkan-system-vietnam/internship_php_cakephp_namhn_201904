<div class="panel-body">
    <h5 style="margin-left: 500px;">Form Add Users</h5>
    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table border="2" style="width: 800px;margin: auto;">
            <tr>
                <th style="width: 200px;text-align: center">Email</th>
                <td><input value="<?php echo $user->email; ?>"
                           name="email" type="email"></td>
            </tr>
            <tr>
                <th style="width: 200px;text-align: center">Password</th>
                <td>
                    <input placeholder="Nhập password mới nếu bạn cần thay đổi"
                           name="password" type="password">
                </td>
            </tr>
            <tr>
                <th style="width: 200px;text-align: center">Name</th>
                <td><input value="<?php echo $user->name; ?>"
                           name="name" type="text"></td>
            </tr>
            <tr>
                <th style="width: 200px;text-align: center">Year Old</th>
                <td><input value="<?php echo $user->yearold; ?>"
                           name="yearold" type="number"></td>
            </tr>
            <tr>
                <th style="width: 200px;text-align: center">Address</th>
                <td><input value="<?php echo $user->address; ?>"
                           name="address" type="text"></td>
            </tr>
            <tr>
                <th style="width: 200px;text-align: center">Telephone</th>
                <td><input value="<?php echo $user->telephone; ?>"
                           name="telephone" type="text"></td>
            </tr>
            <tr>
                <th style="width: 200px;text-align: center">Level</th>
                <td>
                    <?php if ($user->level == 'Admin') { ?>
                        <select name="level">
                            <option value="<?php echo $user->level;?>"><?php echo $user->level;?></option>
                            <option value="Member">Member</option>
                        </select>
                    <?php } ?>
                    <?php if ($user->level == 'Member') { ?>
                        <select name="level">
                            <option value="<?php echo $user->level;?>"><?php echo $user->level;?></option>
                            <option value="Admin">Admin</option>
                        </select>
                    <?php } ?>
                </td>
            </tr>
            <tr style="height: 60px;">
                <th colspan="2">
                    <input style="margin-left: 200px;height: 35px;" class="btn btn-primary" type="submit"
                           value="Submit">
                    <input style="height: 35px;margin-left: 20px;" class="btn btn-danger" type="reset" value="Reset">
                </th>
            </tr>
        </table>
    </form>
</div>