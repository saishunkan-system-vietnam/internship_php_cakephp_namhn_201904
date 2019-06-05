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
</head>
<body class="container-fluid">
<style>
    * {
        margin: 0;
        padding: 0
    }

    body {
        background-color: #DDDDDD;
        font-family: "Times New Roman";
        width: 1300px;
        margin: auto;
    }

    .header {
        background-image: url("<?= URL ?>img/index/header3.jpg");
        height: 280px;
        color: darkred;
        text-align: center;
    }

    .header h1 {
        font-weight: bold;
        font-style: italic;
        padding-top: 80px;
    }

    .menu {
        background-color: white;
    }

    .menu .col-md-4 {
        height: 45px;
    }

    .menu .col-md-4 .search {
        height: 100%;
        border-radius: 7px;
    }

    .menu .col-md-4 button {
        height: 100%;
        border-radius: 7px;
        background-color: #333333;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }

    .menu .col-md-4 button:hover {
        background-color: #1cc7ff;
    }

    .menu .col-md-3 {
        height: 100%;
        font-size: 19px;
        font-weight: bold;
        line-height: 45px;
        font-style: italic;
    }

    .menu .col-md-5 {
        height: 45px;
    }

    .menu .col-md-5 a button {
        height: 100%;
        border-radius: 7px;
        background-color: #333333;
        color: white;
        font-weight: bold;
        font-size: 18px;
        width: 130px;
        max-width: 130px;
    }

    .menu .col-md-5 a button:hover {
        background-color: #1cc7ff;
    }

    .main {
        background-color: white;
    }

    .catalog {
        max-width: 450px;
        margin-top: 30px;
        margin-bottom: 50px;
    }

    .catalog table tr th a button {
        height: 45px;
        width: 100%;
        text-align: left;
        background: white;
        border: 3px solid darkred;
        border-top : none;
        color: darkblue;
    }

    .catalog table tr:nth-child(1) th a button {
        border-top: 3px solid darkred;
    }
    .catalog table tr th a button:hover {
        background-color: #333333;
        color: white;
    }

    .catalog legend {
        margin-bottom: 40px;
    }

    .catalog table tr th a {
        font-size: 18px;
    }

    .footer {
        background-image: url("<?= URL ?>img/index/footer.jpg");
        height: 250px;
    }

    .footer div u i {
        font-size: 40px;
        padding-top: 30px;
    }

    .icon {
        padding-top: 30px;
    }

    .icon i {
        font-size: 30px;
        margin-left: 30px;
    }

    .footer .table tr th {
        font-size: 20px;

    }
</style>
<div class="col-md-12 header">
    <h1>CHÀO MỪNG BẠN TỚI TRANG KHẢO SÁT CỦA CHÚNG TÔI ^^!</h1>
</div>
<div class="col-md-12 menu">
    <div class="col-md-4">
        <input id="search-box" placeholder="Nhập Danh Mục Bạn Muốn Tìm"
               type="text" class="col-md-9 search">
        <button onclick="Search()" class="col-md-3">Search</button>
        <div class="dataShow"></div>
    </div>
    <div class="col-md-3">
        <?php if (isset($HgNam)) { ?>
            <u>Xin Chào : <?= $HgNam[3] ?></u>
        <?php } ?>
    </div>
    <div class="col-md-5">
        <a href="<?= URL ?>actions">
            <button><i class="fas fa-house-damage"></i> Home</button>
        </a>
        <?php if (empty($HgNam)) { ?>
            <a href="<?= URL ?>actions/login">
                <button><i class="fas fa-sign-in-alt"></i>Đăng Nhập</button>
            </a>
            <a href="<?= URL ?>regists">
                <button><i class="fas fa-sign-out-alt"></i>Đăng Ký</button>
            </a>
        <?php }
        if ($HgNam[1] == "Admin") { ?>
            <a href="<?= URL ?>users">
                <button><i class="fas fa-tasks"></i> Admin</button>
            </a>
        <?php }
        if (!empty($HgNam)) { ?>
            <a href="<?= URL ?>actions/logout">
                <button><i class="fas fa-lock"></i> Đăng Xuất</button>
            </a>
        <?php } ?>

    </div>
</div>
<div class="col-md-12 main">
    <div class="col-md-4 menu-left">
        <div class="noName" style="height: 180px;"></div>
        <fieldset class="catalog">
            <legend>[ Danh Mục Khảo Sát ]</legend>
            <table style="width: 100%;max-width: 375px;">
                <?php foreach ($catalog as $key => $value) { ?>
                    <tr>
                        <th class="menu-body"><a href="<?= URL ?>actions/catalog/<?= $value->id ?>">
                                <button>
                                    <i style="margin-left: 5px;" class="fas fa-book"></i> <?= $value->name ?></button>
                            </a></th>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
        <fieldset class="catalog">
            <legend>[ Khảo Sát Mới ]</legend>
            <table style="width: 100%;max-width: 375px;">
                <?php foreach ($dataNew as $value) { ?>
                    <tr>
                        <th>
                            <a href="<?= URL ?>actions/survey/<?= $value->id ?>">
                                <button>
                                    <i style="margin-left: 5px;" class="fas fa-poll-h"></i> <?= $value->name ?>
                                </button>
                            </a>
                        </th>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>
        <div class="fb-page facebook"
             data-href="https://www.facebook.com/Kh%E1%BA%A3o-S%C3%A1t-Ho%C3%A0ng-Nam-604295050072854/?modal=admin_todo_tour"
             data-tabs="timeline" data-width="400"
             data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
             data-show-facepile="true">
            <blockquote
                    cite="https://www.facebook.com/Kh%E1%BA%A3o-S%C3%A1t-Ho%C3%A0ng-Nam-604295050072854/?modal=admin_todo_tour"
                    class="fb-xfbml-parse-ignore"><a
                        href="https://www.facebook.com/Kh%E1%BA%A3o-S%C3%A1t-Ho%C3%A0ng-Nam-604295050072854/?modal=admin_todo_tour">Facebook</a>
            </blockquote>
        </div>
    </div>
    <div class="col-md-8 content">
        <?= $this->Fetch('content') ?>
    </div>
</div>
<div class="footer col-md-12">
    <div style="text-align: center;padding-top: 20px">
        <u><i>Saishunkan System Vietnam23132123</i></u></div>
    <div class="col-md-4 icon col-md-offset-4">
        <i class="fab fa-facebook-square"></i>
        <i class="fab fa-skype"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-yahoo"></i>
        <i class="fas fa-sms"></i>
        <i class="fas fa-gift"></i>
    </div>
    <div class="col-md-3 pull-right">
        <table class="table">
            <tr>
                <th><span>Design by<span><span>: NamHN<span></th>
            </tr>
            <tr>
                <th><span>Team<span><span style="margin-left: 35px;">: Anh Chính<span></th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
<script>
    // Sử Lý Search
    function Search() {
        search = $(".search").val();
        $.ajax({
            url: '<?= URL ?>actions/search?search=' + search,
            type: 'GET',
            success: function (res) {
                window.location.replace("<?= URL ?>actions/catalog/" + res);
            }
        });
    }
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3">
</script>
<script>
    // Sử Lý Suggesst Search
    $(document).ready(function () {
        $('.noName').hide();
        $("#search-box").keyup(function () {
            key = $("#search-box").val();
            if (key != '') {
                $.ajax({
                    url: '<?= URL ?>actions/key?key=' + key,
                    type: 'GET',
                    success: function (res) {
                        if (res != '') {
                            $('.noName').show();
                        }
                        $('.dataShow').html(res).show();
                        console.log(res);
                        <?php foreach ($catalog as $key => $value) { ?>
                        $('#H<?= $value->id ?>').click(function () {
                            HgNam = $('#H<?= $value->id ?>').text();
                            $("#search-box").val(HgNam);
                            $('.H').hide();
                            $('.noName').hide();
                        });
                        <?php }?>
                    }
                });
            } else {
                $('.dataShow').hide();
                $('.noName').hide();
            }
        });
    });
</script>