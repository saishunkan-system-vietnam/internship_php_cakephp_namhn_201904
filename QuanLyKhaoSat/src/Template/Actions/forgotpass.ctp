<fieldset class="col-md-10 col-md-offset-1" style="margin-top: 80px;" id="Forgot">
    <legend>Quên Mật Khẩu</legend>
    <?php if (!empty($error)) {?>
        <div class="col-md-12" style="margin-bottom:20px;font-weight: bold;text-align: center;color: white; background: #222222;height: 50px;line-height: 50px;font-size: 16px;text-align: center">
            Thông Tin Bạn Nhập Không Chính Xác ^^!
        </div>
    <?php } if (!empty($success)) { ?>
        <div class="col-md-12" style="margin-bottom: 20px;font-weight: bold;text-align: center;color: white; background: darkblue;height: 50px;line-height: 50px;font-size: 16px;text-align: center">
            Check Thông Tin Thành Công Bạn Vui Lòng Kiếm Tra Email và Làm Theo Hướng Dẫn ^^!
        </div>
    <?php }?>
    <form action="" id="formForgot" method="post">
        <table class="table table-bordered">
            <tr>
                <th>Nhập Tài Khoản</th>
                <th><input style="height: 40px;" type="email"  name="email"
                           placeholder="Nhập Tài Khoản" class="form-control"></th>
            </tr>
            <tr>
                <th>Câu Hỏi Bí Mật</th>
                <th>
                    <select style="height: 40px;" name="secret_q" class="form-control">
                        <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                        <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                        <option value="Người Yêu Đầu Tiên Của Bạn Là Ai ?">Người Yêu Đầu Tiên Của Bạn Là Ai ?</option>
                        <option value="Vì Sao Bạn Học Lập Trình ?">Vì Sao Bạn Học Lập Trình ?</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Nhập Đáp Án</th>
                <th>
                    <input name="secret_a" style="height: 40px;" type="text" placeholder="Nhập Đáp Án" class="form-control">
                </th>
            </tr>
            <tr>
                <th style="background-color: white;border: none"></th>
                <th><button type="submit" id="success">Đồng ý</button></th>
            </tr>
        </table>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/forgot'); ?>
