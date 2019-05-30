<style>
    .survey {
        float: left;
        border: 3px solid black;
        width: 200px;
        height: 260px;
        background-color: #DDDDDD;
        margin-left: 40px;
        margin-bottom: 40px;
    }

    img {
        height: 170px;
        width: 170px;
        margin-top: 15px;
        margin-left: 12px;
        border: 3px solid black;

    }

    .name {

        font-family: "Times New Roman";
        text-align: center;
        font-weight: bold;
        color: darkred;
        font-size: 18px;
        padding-top: 20px;
    }

    legend {
        font-size: 30px;
        font-family: "Times New Roman";
        font-weight: bold;
        color: black;
        margin-bottom: 50px;
    }
    .errorT {
        font-size: 30px;
        color: red;
        font-weight: bold;
        margin-top: 30px;
        border-bottom: 1px solid #DDDDDD;
    }
    .errorB {
        font-size: 30px;
        color: red;
        font-weight: bold;
        margin-top: 30px;
        border-bottom: 1px solid #DDDDDD;
        text-align: right;
    }
</style>
<?php if (empty($dataOff) && empty($dataOn)) { ?>
    <div class="errorT">Danh Mục Hiện Tại Chưa Có Khảo Sát .....................................</div>
    <div class="errorB">.................................................. Xin Vui Lòng Quay Lại Sau ^^!</div>
<?php } else { ?>
    <fieldset class="public-survey" style="border: none;margin-top: 30px">
        <legend>[ Khảo Sát Công Khai ]</legend>
        <?php foreach ($dataOff as $value) { ?>
        <a href="<?= URL ?>actions/survey/<?= $value->id ?>">
            <?php if (($value->maximum != '' && $value->count >= $value->maximum) || $value->status == "closed" || ($value->end_time != '' && strtotime($value->end_time) < strtotime(date('Y-m-d H:i:s')))) { ?>
            <?php } else { ?>
                <div class="survey">
                    <?php if ($value->img_survey != '') { ?>
                        <img src="<?= URL ?>img/survey/<?= $value->img_survey ?>" alt="">
                    <?php } else { ?>
                        <img src="<?= URL ?>img/survey/no_images.jpg" alt="">
                    <?php } ?>
                    <div class="name"><?= $value->name ?></div>
                </div>
                </a>
            <?php }
        } ?>
    </fieldset>
    <fieldset class="public-survey" style="border: none;margin-top: 100px">
        <legend>[ Khảo Sát Riêng Tư ]</legend>
        <?php if (!isset($HgNam)) { ?>
            <blockquote>
                <i><u style="font-size: 25px;">Lưu Ý :</u></i>
                <footer style="font-size: 20px">Để Thực Hiện Khảo Sát Riêng Tư Bạn Cần Phải Đăng Nhập</footer>
                <footer style="font-size: 20px">Nếu Chưa Có Tài Khoản , Vui Lòng Hãy Đăng Ký Làm Thành Viên Của Chúng
                    Tôi.
                </footer>
            </blockquote>
        <?php } ?>
        <?php foreach ($dataOn as $value) { ?>
        <a <?php if (isset($HgNam)) { ?>
            href="<?= URL ?>actions/survey/<?= $value->id ?>"
        <?php } ?>>
            <?php if (($value->maximum != '' && $value->count >= $value->maximum) || $value->status == "closed" || ($value->end_time != '' && strtotime($value->end_time) < strtotime(date('Y-m-d H:i:s')))) { ?>
            <?php } else { ?>
                <div class="survey">
                    <?php if ($value->img_survey != '') { ?>
                        <img src="<?= URL ?>img/survey/<?= $value->img_survey ?>" alt="">
                    <?php } else { ?>
                        <img src="<?= URL ?>img/survey/no_images.jpg" alt="">
                    <?php } ?>
                    <div class="name"><?= $value->name ?></div>
                </div>
                </a>
            <?php }
        } ?>
    </fieldset>
<?php } ?>
