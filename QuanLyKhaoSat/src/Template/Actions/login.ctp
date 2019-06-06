<style>
    fieldset {
        margin-top: 40px;
    }

    legend {
        text-align: center;
        font-weight: bold;
    }

    th {
        text-align: center;
        height: 50px;
        font-size: 18px;
    }

    .form-control {
        height: 50px;
        font-size: 18px;
    }
</style>
<fieldset class="col-md-8 col-md-offset-2">
    <legend style="">[ Đăng Nhập ]</legend>
    <div class="btn btn-danger error">Sai Thông Tin</div>
    <table class="table table-bordered">
        <tr>
            <th style="line-height: 40px;"><i class="fas fa-user-graduate"></i> Tài Khoản</th>
            <th><input type="email" name="email" id="email"
                       placeholder="Nhập Tài Khoản" class="form-control"></th>
        </tr>
        <tr>
            <th style="line-height: 40px;"><i class="fas fa-unlock-alt"></i> Mật Khẩu</th>
            <th><input type="password" name="password" id="password"
                       placeholder="Nhập Mật Khẩu" class="form-control"></th>
        </tr>
        <tr>
            <th></th>
            <th>
                <button type="button" onclick="login()" style="height: 50px;border-radius: 7px;background-color: #222222;color: white;width: 120px;">Đăng Nhập</button>
                <a href="<?= URL ?>actions/forgotpass">
                    <button type="button" style="height: 50px;width: 150px;border-radius: 7px;background-color: #222222;color: white">Quên Mật Khẩu</button>
                </a>
            </th>
        </tr>
    </table>
</fieldset>
<?php echo $this->Html->script('validate/login'); ?>
<script>
    $(document).ready(function () {
        $('.error').hide();
    });

    function login() {
        email = $('#email').val();
        password = $('#password').val();
        $.ajax({
            url: '<?= URL ?>actions/checklogin?email=' + email + '&password=' + password,
            type: 'GET',
            success: function (res) {
                if (res == 'error') {
                    $('.error').show();
                    console.log(res);
                }
                if (res == 'success') {
                    window.location.replace("<?= URL ?>actions");
                }
            }
        });
    }
</script>
