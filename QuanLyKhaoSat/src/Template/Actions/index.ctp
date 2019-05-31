<style>
    .survey {
        float: left;
        border: 3px solid black;
        width: 200px;
        height: 260px;
        background-color: #DDDDDD;
        margin-left: 55px;
        margin-bottom: 40px;
    }

    .survey img {
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
</style>
<fieldset style="margin-top: 60px;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?= URL ?>img/index/slide3.jpg" style="width: 100%;height: 300px;">
            </div>
            <div class="item">
                <img src="<?= URL ?>img/index/slide2.jpg" style="width:100%;height: 300px">
            </div>
            <div class="item">
                <img src="<?= URL ?>img/index/slide1.jpg" style="width:100%;height: 300px">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</fieldset>
<fieldset class="public-survey" style="border: none;margin-top: 30px;">
    <legend>[ Khảo Sát Công Khai ]</legend>
    <?php foreach ($SurveyOff as $value) { ?>
    <a href="<?= URL ?>actions/survey/<?= $value->id ?>">
        <?php if (($value->maximum != '' && $value->count >= $value->maximum) || $value->status == "closed" || ($value->end_time != '' && strtotime($value->end_time) < strtotime(date('Y-m-d H:i:s')))) { ?>
        <?php } else { ?>
            <div class="survey">
                <?php if ($value->img_survey != '') { ?>
                    <img src="<?= URL ?>img/survey/<?= $value->img_survey ?>" alt="">
                <?php } else { ?>
                    <img src="<?= URL ?>img/survey/noimage.jpg" alt="">
                <?php } ?>
                <div class="name"><?= $value->name ?></div>
            </div>
            </a>
        <?php }
    } ?>
</fieldset>
