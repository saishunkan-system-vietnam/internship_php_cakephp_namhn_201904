<!DOCTYPE html>
<html lang="en">
<head>
    <title>QUản Lý Khảo Sát</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript"
            src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
</head>
<style>
    body {
        background-color: #222222;
        font-family: "Times New Roman";
        color: black;
        height: 2000px;
    }

    .header {
        font-weight: bold;
        font-size: 16px;
    }
    .header ul li a {
        font-size: 19px;
    }
    fieldset {
        margin-top: 50px;
        border: 2px solid white;
        border-radius: 10px;
        font-size: 16px;
    }

    legend {
        color: white;
        text-align: center;
        font-size: 28px;
    }

    table {
        background-color: #DDDDDD;
        font-weight: bold;
        color: black;
    }

    .button {
        height: 40px;
        width: 80px;
        background: linear-gradient(to right,#050929,white,#5BC8BD);
        color: black;
        font-size: 16px;
        border-radius: 7px;
        font-weight: bold;
    }

    button:hover {
        background: linear-gradient(to right,#5BC8BD,#050929,white);
        color: white;
    }

    .col-md-4 {
        text-align: center;
        color: white;
        font-weight: bold;
        font-size: 17px;
    }

</style>
<body>

<nav class="navbar navbar-inverse header" style="position: sticky;top: 0; z-index: 10 ">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="<?= URL ?>indexs" class="navbar-brand" style="font-size: 19px;"><i class="fas fa-tasks"></i> Thực Hiện Khảo Sát</a>
        </div>
        <ul class="nav navbar-nav pull-right">
            <li><a href="<?= URL ?>homes"><i class="fas fa-house-damage"></i> Home</a></li>
            <li><a href="<?= URL ?>catalogs"><i class="fas fa-journal-whills"></i> Danh Mục Khảo Sát</a></li>
            <li><a href="<?= URL ?>surveys"><i class="fas fa-file-signature"></i> Khảo Sát</a></li>
<!--            <li><a href="--><?//= URL ?><!--questions"><i class="fas fa-comment-dots"></i> Questions</a></li>-->
            <li><a href="<?= URL ?>users"><i class="fas fa-user-injured"></i> Users</a></li>
            <li><a href="<?= URL ?>users/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <?= $this->Fetch('content') ?>
</div>

</body>
</html>
