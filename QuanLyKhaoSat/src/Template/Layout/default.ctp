<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript"
            src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="" style="font-weight: bold;font-size: 18px;">Quản Lý Khảo Sát</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= SITE_URL ?>homes" style="font-weight: bold;font-size: 18px;">Home</a></li>
                <li><a href="<?= SITE_URL ?>catalogs" style="font-weight: bold;font-size: 18px;">Quản Lý Khảo Sát</a></li>
                <li><a href="<?= SITE_URL ?>surveys" style="font-weight: bold;font-size: 18px;">Khảo Sát</a></li>
                <li><a href="<?= SITE_URL ?>users" style="font-weight: bold;font-size: 18px;">Users</a></li>
                <li><a href="<?= SITE_URL ?>users/logout" style="font-weight: bold;font-size: 18px;">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</nav>
<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
