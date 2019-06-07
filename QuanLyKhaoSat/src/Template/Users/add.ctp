<style>
    th {
        text-align: left;
    }
</style>
<fieldset class="col-md-6 col-md-offset-3">
    <?php if (isset($error->email)) { ?>
        <div class="alert alert-danger">
            Email Đã Tồn Tại, Xin Vui Lòng NHập Email Khác ^^!
        </div>
    <?php } ?>
    <?php if (isset($errorPass)) { ?>
        <div class="alert alert-danger">
            Mật Khẩu Nhập Lại Không Trùng Khớp ^^!
        </div>
    <?php } ?>
    <?php if (isset($errorBirth)) { ?>
        <div class="alert alert-danger">
            Ngày Sinh Nhập Đã Lỗi ^^!
        </div>
    <?php } ?>
    <legend>
        ADD Users
    </legend>
    <form action="<?= URL ?>users/add" id="Users" method="post">
        <table class="table table-hover table-bordered ">
                <form action="<?= URL ?>users/add" id="Users" method="post">
                <table class="table table-hover table-bordered ">
                    <tr>
                        <th class="col-md-4">Tài Khoản <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập tài khoản"
                                   value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                                   type="email" name="email" id="email" class="form-control email"></td>
                    </tr>
                    <tr id="show">
                        <th></th>
                        <th style="font-weight: bold" class="dataShow"></th>
                    </tr>
                    <tr>
                        <th>Mật Khẩu <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập mật khẩu"
                                   value="<?php echo isset($result[1]) ? $result[1] : '' ?>"
                                   type="password" id="pass1" name="password1" class="form-control"></td>
                    </tr>
                    <tr id="pass2">
                        <th>Nhập Lại Mật Khẩu <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập lại mật khẩu"
                                   value="<?php echo isset($result[2]) ? $result[2] : '' ?>"
                                   type="password" name="password2" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Họ và Tên <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập họ và tên của bạn"
                                   value="<?php echo isset($result[3]) ? $result[3] : '' ?>"
                                   type="text" name="fullname" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập địa chỉ"
                                   value="<?php echo isset($result[4]) ? $result[4] : '' ?>"
                                   type="text" name="address" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Số Điện Thoại <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập số điện thoại"
                                   value="<?php echo isset($result[5]) ? $result[5] : '' ?>"
                                   type="text" id="tel" name="phone" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Ngày/Tháng/Năm Sinh <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập Ngày / Tháng / Năm Sinh"
                                   value="<?php echo isset($result[6]) ? $result[6] : '' ?>"
                                   type="date" name="birth" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Chức Vụ <span style="color: red">( * )</span></th>
                        <td colspan="2"><select name="level" class="form-control">
                                <?php if (isset($result[7]) && $result[7] == "Admin") { ?>
                                    <option value="Admin">Admin</option>
                                    <option value="Member">Member</option>
                                <?php }
                                if (isset($result[7]) && $result[7] == "Member") { ?>
                                    <option value="Member">Member</option>
                                    <option value="Admin">Admin</option>
                                <?php }
                                if (!isset($result[7])) { ?>
                                    <option value="Member">Member</option>
                                    <option value="Admin">Admin</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Câu Hỏi Bí Mật <span style="color: red">( * )</span></th>
                        <td><select name="secret_q" class="form-control">
                                <?php if (isset($result[8]) && $result[8] == "Trường Đại Học Của Bạn Là Gì ?" || !isset($result[8])) { ?>
                                    <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?
                                    </option>
                                    <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?
                                    </option>
                                    <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?
                                    </option>
                                <?php }
                                if (isset($result[8]) && $result[8] == "Tác Phẩm Bạn Thích Nhất Là Gì ?") { ?>
                                    <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?
                                    </option>
                                    <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?
                                    </option>
                                    <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?
                                    </option>
                                <?php }
                                if (isset($result[8]) && $result[8] == "Môn Học Bạn Thích Nhất Là Gì ?") { ?>
                                    <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?
                                    </option>
                                    <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?
                                    </option>
                                    <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?
                                    </option>
                                <?php } ?>
                            </select></td>
                    </tr>
                    <tr>
                        <th>Câu Trả Lời <span style="color: red">( * )</span></th>
                        <td><input placeholder="Nhập câu trả lời cho câu hỏi bí mật"
                                   value="<?php echo isset($result[9]) ? $result[9] : '' ?>"
                                   type="text" name="secret_a" class="form-control"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button class="btn btn-primary" id="submit" type="submit"><i class="far fa-thumbs-up"></i>
                                Submit
                            </button>
                            <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                        </td>
                    </tr>
                </table>
            </form>
</fieldset>
<?php echo $this->Html->script('validate/Users/add'); ?>