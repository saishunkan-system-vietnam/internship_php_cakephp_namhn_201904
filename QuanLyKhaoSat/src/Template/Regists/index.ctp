<style>
    body {
        background-color: #222222;
        font-family: "Times New Roman";
        color: black;
    }

    .header {
        font-weight: bold;
        font-size: 16px;
    }
    fieldset{
        margin-top: 50px   ;
        border: 2px solid white;
        border-radius: 10px ;
        font-size: 16px;
    }
    legend {
        color: white;
        text-align: center;
        font-size: 28px;
    }
    table{
        background-color: #DDDDDD;
        font-weight: bold;
        color: black;
    }
    tr {
        height: 60px ;
    }
    tr:nth-child(1){
        font-size: 18px;
    }
    tr th {
        text-align: center;
    }
    .button{
        height: 40px;width: 80px;
        background-color: #777777;
        color: black;
        font-size: 16px;
    }
    button:hover{
        background-color: #222222;
        color: white;
    }
</style>
<fieldset class="col-md-8 col-md-offset-2">
    <?php if (isset($data->email)) { ?>
        <div class="alert alert-danger">
            Email đã tồn tại, xin vui lòng NHập email khác !
        </div>
    <?php } ?>
    <legend>
        Đăng kí làm thành viên
    </legend>
    <form action="" method="post" id="formRegisters">
        <table class="table table-hover">
            <tr>
                <th>Tài Khoản</th>
                <td><input type="email" name="email" class="form-control"></td>
            </tr>
            <tr>
                <th>Mật Khẩu</th>
                <td><input type="password" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Họ và Tên</th>
                <td><input type="text" name="fullname" class="form-control"></td>
            </tr>
            <tr>
                <th>Địa Chỉ</th>
                <td><input type="text" name="address" class="form-control"></td>
            </tr>
            <tr>
                <th>Điện Thoại</th>
                <td><input type="text" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Ngày Sinh</th>
                <td><input type="date" name="birth" class="form-control"></td>
            </tr>
            <tr>
                <th style="line-height: 50px;">Câu Hỏi Bí Mật</th>
                <td><select name="secret_q" class="form-control">
                        <option value="Trường Đại Học Của Bạn Là Gì ?">Trường Đại Học Của Bạn Là Gì ?</option>
                        <option value="Môn Học Bạn Thích Nhất Là Gì ?">Môn Học Bạn Thích Nhất Là Gì ?</option>
                        <option value="Người Yêu Đầu Tiên Của Bạn Là Ai ?">Người Yêu Đầu Tiên Của Bạn Là Ai ?</option>
                        <option value="Vì Sao Bạn Học Lập Trình ?">Vì Sao Bạn Học Lập Trình ?</option>
                    </select></td>
            </tr>
            <tr>
                <th>Nhập Đáp Án</th>
                <th>
                    <input name="secret_a" type="text" class="form-control">
                </th>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button class="button" type="submit">Đăng Ký</button>
                </td>
            </tr>
        </table>
        <div>
            <a href="<?= URL ?>users/login" class="btn btn-danger pull-right" style="font-weight: bold;">Tới Trang Đăng Nhập</a>
            <a href="<?= URL ?>actions" class="btn btn-primary pull-right" style="font-weight: bold;">Tới Trang Khảo Sát</a>
        </div>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/registers'); ?>