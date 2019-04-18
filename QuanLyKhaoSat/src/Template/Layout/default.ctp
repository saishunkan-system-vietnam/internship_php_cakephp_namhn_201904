<?php

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự án quản lý khảo sát</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<nav class="top-bar expanded" data-topbar role="navigation">
    <ul class="title-area large-3 medium-4 columns">
        <li class="name">
            <h1><a href="">DỰ ÁN QUẢN LÝ KHẢO SÁT</a></h1>
        </li>
    </ul>
    <style>
        li {
            float: left;
            list-style: none;
        }

        li a {
            display: block;
            color: black;
            text-align: center;
            padding: 16px;
            text-decoration: none;
            font-weight: bold;
        }

        li a:hover {
            background-color: #111111;
            color: white;
        }
    </style>
</nav>
<!--<li class="active"><a href="--><?//= SITE_URL; ?><!--home">Home</a></li>-->
<!--<li class="active"><a href="--><?//= SITE_URL; ?><!--survey">Quản lý khảo sát</a></li>-->
<!--<li class="active"><a href="--><?//= SITE_URL; ?><!--users">Quản lý user</a></li>-->
<!--<li class="active"><a href="--><?//= SITE_URL; ?><!--">Đăng xuất</a></li>-->
<!--<div style="clear: both"></div>-->
<?= $this->Flash->render() ?>
<div style="margin-top: 50px;" class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
