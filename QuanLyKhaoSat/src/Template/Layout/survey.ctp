<!DOCTYPE html>
<html lang="en">
<head>
    <title>QUản Lý Khảo Sát</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body style="height: 1500px">
<style>
    .header {
        font-weight: bold;
        font-size: 18px;
        height: 55px;
    }

    .btn {
        font-weight: bold;
        height: 35px;
        width: 80px ;
    }

    fieldset {
        border: 2px solid #222222;
        border-radius: 10px;
        font-family: "Times New Roman";
        margin-top: 60px;
        font-size: 17px;
    }

    legend {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        width: 500px;
        height: 50px;
        line-height: 60px;
        border: 2px solid #222222;
        border-radius: 10px;
        border-bottom: none;
        border-top: none;
    }
    th {
        text-align: center;
    }
    td {
        text-align: center;
    }
    .alert-danger {
        text-align: center;
        font-weight: bold;
    }
</style>


<div class="container-fluid">
    <?= $this->Fetch('content') ?>
</div>
<?php echo $this->Html->script('checkbox.js'); ?>
</body>
</html>
