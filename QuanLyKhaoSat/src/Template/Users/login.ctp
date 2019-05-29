<style>
    fieldset {
        margin-top: 80px;
        border: 2px solid #222222;
        /*border-radius: 10px;*/
        font-size: 17px;
    }

    legend {
        text-align: center;
        width: 50%;
        font-weight: bold;
        margin-bottom: 50px;
        font-size: 35px;
    }

    table {
        background-color: #222222;
        color: white;
    }

    th {
        text-align: center;
        height: 60px;
        font-size: 20px;
    }

    .form-control {
        height: 45px;
        font-size: 18px;
    }
    button {
        background-color: #222222;
        height: 50px;
        width: 150px;
        color: white;
        font-weight: bold;
        font-size: 17px;
    }
    .error {
        width: 100%;
        height: 60px;
        line-height: 50px;
        font-size: 16px;
        margin-bottom: 50px;
    }
</style>
<fieldset class="col-md-6 col-md-offset-3">
    <legend style="">Đăng Nhập</legend>
    <?php if (!empty($error)) {?>
        <div class="btn btn-danger error">
            Bạn Đã Nhập Sai Tài Khoản Hoặc Mật Khẩu, Xin Vui Lòng Nhập Lại
        </div>
    <?php } ?>
    <form action="" id="formLogin" method="post">
        <table class="table table-bordered">
            <tr>
                <th class="col-md-4"><i class="fas fa-user-graduate"></i> Tài Khoản
                </th>
                <th><input type="email"  name="email"
                           placeholder="Nhập Tài Khoản" class="form-control"></th>
            </tr>
            <tr>
                <th><i  class="fas fa-unlock-alt"></i> Mật Khẩu</th>
                <th><input type="password"  name="password"
                           placeholder="Nhập Mật Khẩu" class="form-control"></th>
            </tr>
            <tr>
                <th></th>
                <th>
                    <button type="submit">Đăng Nhập</button>
                    <a href="<?= URL ?>regists/forgotpass">
                    <button  type="button" >Quên Mật Khẩu</button></a>
                </th>
            </tr>
        </table>
        <a  class="pull-right" href="<?= URL ?>regists">
            <button type="button">Trang Đăng Ký</button>
        </a>
        <a  class="pull-right" href="<?= URL ?>actions">
            <button type="button">Trang Khảo Sát</button>
        </a>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/login'); ?>