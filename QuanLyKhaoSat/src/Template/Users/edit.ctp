<?php if (empty($data)) { ?>
    <a href="<?= URL ?>users"><h1><u style="color: red;font-weight: bold">Đường Dẫn Này Không Tồn Tại</u></h1></a>
<?php } else { ?>
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
        <legend>
            Edit Users
        </legend>
        <form action="<?= URL ?>users/edit/<?php echo $data->id ?>" id="Users" method="post">
            <table class="table table-hover">
                <tr>
                    <th class="col-md-4">Tài Khoản</th>
                    <td><input value="<?php echo isset($result[0]) ? $result[0] : $data->email ?>"
                               type="email" name="email" onchange="checkEmail()" class="form-control email"></td>
                </tr>
                <tr id="show">
                    <th></th>
                    <td class="dataShow"></td>
                </tr>
                <tr>
                    <th>Mật Khẩu</th>
                    <td><input placeholder="Nhập Mật Khẩu Mới Nếu Bạn Muốn Đổi"
                               type="password" name="password1" class="form-control" id="pass1"></td>
                </tr>
                <tr id="pass2">
                    <th>Nhập Lại Mật Khẩu</th>
                    <td><input placeholder="Nhập Lại Mật Khẩu Bạn Vừa Nhập"
                               type="password" name="password2" class="form-control"></td>
                </tr>
                <tr>
                    <th>Họ và Tên</th>
                    <td><input value="<?php echo isset($result[3]) ? $result[3] : $data->fullname ?>"
                               type="text" name="fullname" class="form-control"></td>
                </tr>
                <tr>
                    <th>Địa Chỉ</th>
                    <td><input value="<?php echo isset($result[4]) ? $result[4] : $data->address ?>"
                               type="text" name="address" class="form-control"></td>
                </tr>
                <tr>
                    <th>Số Điện Thoại</th>
                    <td><input value="<?php echo isset($result[5]) ? $result[5] : $data->phone ?>"
                               type="text" id="tel" name="phone" class="form-control"></td>
                </tr>
                <tr>
                    <th>Ngày/Tháng/Năm Sinh</th>
                    <td><input value="<?php echo isset($result[6]) ? $result[6] : $data->birth ?>"
                               type="date" name="birth" class="form-control"></td>
                </tr>
                <tr>
                    <th>Chức Vụ</th>
                    <td><select name="level" class="form-control">
                            <?php if ($data->level == 'Admin') { ?>
                                <option value="Admin">Admin</option>
                                <option value="Member">Member</option>
                            <?php } ?>
                            <?php if ($data->level == 'Member') { ?>
                                <option value="Member">Member</option>
                                <option value="Admin">Admin</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Câu Hỏi Bí Mật</th>
                    <td>
                        <?php if ($data->secret_q == "Trường Đại Học Của Bạn Là Gì ?") { ?>
                            <select name="secret_q" class="form-control">
                                <option value="<?php echo isset($result[8]) ? $result[8] : $data->secret_q ?>">
                                    <?php echo isset($result[8]) ? $result[8] : $data->secret_q ?>
                                </option>
                                <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                                <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?</option>
                            </select>
                        <?php } ?>
                        <?php if ($data->secret_q == "Môn Học Bạn Thích Nhất Là Gì ?") { ?>
                            <select name="secret_q" class="form-control">
                                <option value="<?php echo isset($result[8]) ? $result[8] : $data->secret_q ?>">
                                    <?php echo isset($result[8]) ? $result[8] : $data->secret_q ?>
                                </option>
                                <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                                <option value="Tác Phẩm Bạn Thích Nhất Là Gì ?">Tác Phẩm Bạn Thích Nhất Là Gì ?</option>
                            </select>
                        <?php } ?>
                        <?php if ($data->secret_q == "Tác Phẩm Bạn Thích Nhất Là Gì ?") { ?>
                            <select name="secret_q" class="form-control">
                                <option value="<?php echo isset($result[8]) ? $result[8] : $data->secret_q ?>">
                                    <?php echo isset($result[8]) ? $result[8] : $data->secret_q ?>
                                </option>
                                <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                                <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                            </select>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Câu Trả Lời</th>
                    <td><input value="<?php echo isset($result[9]) ? $result[9] : $data->secret_a ?>"
                               class="form-control" name="secret_a" type="text" id="secret_a"></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="btn btn-primary" type="submit"><i class="far fa-thumbs-up"></i> Submit</button>
                        <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
<?php } ?>
<?php echo $this->Html->script('validate/Users/edit'); ?>