<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php echo $this->Html->css('login'); ?>
    <title>Document</title>
</head>
<body>
<style>
    .banner {
        background-color: white;
        margin: auto;
        width: 500px;
        text-align: center;
        height: 50px;
        line-height: 50px;
        font-size: 20px;
        font-family: 'Times New Roman';
        border-radius: 7px;
        font-weight: bold;
    }
    .banner a{
        color: #7E7E7E;
    }
</style>
<div class="container" style="margin-top: 100px">
    <div class="banner">
        <a href="<?= URL ?>actions">Thực Hiện Khảo Sát</a>
    </div>
    <section id="content" style="margin-top: 50px;">
        <form action="" id="formLogin" method="post">
            <h1>"Đăng Nhập"</h1>
            <div class="row form-group">
                <div class="col-md-1"><i class="fas fa-user-injured" style="font-size: 32px;margin-top: 10px;"></i>
                </div>
                <div class="col-md-11"><input type="text" placeholder="Users name" name="email"/></div>
            </div>
            <div class="row form-group">
                <div class="col-md-1"><i class="fas fa-unlock-alt" style="font-size: 30px;margin-top: 10px;"></i></div>
                <div class="col-md-11"><input type="password" placeholder="Password" name="password"/></div>
            </div>
            <div>
                <input type="submit" value="Đăng Nhập"/>
                <a style="font-size: 18px" href="<?= URL ?>regists/regist">Register</a>
            </div>
        </form>
        <div class="button" style="font-weight: bold;">
            <a>QUẢN LÝ KHẢO SÁT</a>
        </div>
    </section>
</div>
</body>
</html>
<?php echo $this->Html->script('validate/login'); ?>