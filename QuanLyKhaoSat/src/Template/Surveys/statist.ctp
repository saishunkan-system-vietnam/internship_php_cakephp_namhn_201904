<style>
    fieldset {
        font-family: "Times New Roman";
        font-size: 20px;
    }

    legend {
        font-size: 25px;
        width: 500px;
        overflow: hidden;
    }

    th {
        text-align: left;
    }

    td {
        text-align: left;
    }

    .error {
        font-size: 30px;
        font-weight: bold;
        color: red;
        text-align: center;
        margin-top: 30px;
    }

    #errorback {
        background-color: #1a1a1a;
        color: white;
        font-weight: bold;
        height: 50px;
        line-height: 40px;
        width: 200px;
        font-size: 22px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    #errorback:hover {
        background-color: #1cc7ff;
    }
</style>
<fieldset class="col-md-8 col-md-offset-2">
    <legend>Thống Kê <?= $dataS->name ?></legend>
    <?php if (empty($data)) { ?>
        <div class="error">Khảo Sát Hiện Tại Chưa Có Thống Kê</div>
        <a href="<?= URL ?>users" class="pull-right">
            <button id="errorback" type="button">Back To Home</button>
        </a>
    <?php }else { ?>
    <?php foreach ($data as $key => $value) { ?>
        <table class="table table-hover table-bordered">
            <?php if ($value['Questions']['type_question'] == "Text") { ?>
                <tr>
                    <th colspan="3">Câu hỏi <?= $key + 1 ?> (" <?= $value->type_answer ?> ")
                        : <?= $value['Questions']['name'] ?></th>
                </tr>
            <?php } else { ?>
                <tr>
                    <th colspan="3">Câu hỏi <?= $key + 1 ?> (<?= $value->type_answer ?>) :
                        <img style="width: 200px;height: 100px;"
                             src="<?= URL ?>/img/<?= $value['Questions']['name'] ?>"></th>
                </tr>
            <?php } ?>
            <!--               Thống Kê Câu Trả Lời Dạng Text and TextArea               -->
            <?php if ($value->type_answer == "Text" || $value->type_answer == "TextArea") { ?>
                <tr>
                    <th style="text-align: center">Khảo Sát</th>
                    <th style="text-align: center">Người Khảo Sát</th>
                    <th style="text-align: center">Đáp Án Trả Lời</th>
                </tr>
                <?php $answerT = explode(',', $value->answer);
                $userAnswer = explode(',', $value->user_answer);
                $dem = explode(',', $value->dem2);
                for ($i = 0; $i < count($userAnswer); $i++) {
                    ?>
                    <tr>
                        <th style="width: 20%;">Khảo Sát Lần <?= $dem[$i] ?></th>
                        <th style="width: 30%"><?= $userAnswer[$i] ?></th>
                        <th><?= $answerT[$i] ?></th>
                    </tr>
                <?php } ?>
                <!-- ==  End Text and TextArea  == -->
                <!-- Thống kê câu trả lời dạng Images -->
            <?php } elseif ($value->type_answer == "Images") {
                $answerI = explode(',', $value->answer);
                $userAnswer = explode(',', $value->user_answer);
                $dem = explode(',', $value->dem2);
                for ($i = 0; $i < count($userAnswer); $i++) { ?>
                    <tr>
                        <th style="width: 20%;">Khảo Sát Lần <?= $dem[$i] ?></th>
                        <th style="width: 30%"><?= $userAnswer[$i] ?></th>
                        <th><img style="width: 150px;height: 110px;" src="<?= URL ?>img/answer/<?= $answerI[$i] ?>"
                                 alt=""></th>
                <?php }
            } // Thống Kê Câu Trả Lời Dạng Checkbox , Radio , Select
            else { ?>
                <?php
                $answers = $value['Questions']['answers'];
                $answers = explode(',', $answers);
                $userAnswer = explode(',', $value->user_answer);
                $answers = array_unique($answers);
                for ($i = 0; $i < count($answers); $i++) { ?>
                    <tr>
                        <td><p style="width: 250px;float: left">Đáp án : <?= $answers[$i]; ?></p>
                            <!-- Trigger the modal with a button -->
                            <?php $answer = explode(',', $value->answer);
                            $dem = 0;
                            for ($j = 0; $j < count($answer); $j++) {
                                if ($answers[$i] == $answer[$j]) {
                                    $dem++;
                                }
                            }
                            $statis = ($dem / $dataS->count) * 100;
                            $statis = round($statis, 2);
                            if ($statis != 0.0) { ?>
                                <button style="float: left" type="button" class="btn btn-danger btn-detail"
                                        data-id="<?= $i ?>"
                                        data-toggle="modal"
                                        onclick="abc('<?= $value->question_id ?>','<?= $answers[$i] ?>','<?= $value->question_id . $i ?>');"
                                        data-target="#myModal<?= $value->question_id . $i ?>">Detail
                                </button>
                            <?php } ?>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?= $value->question_id . $i ?>" role="dialog">
                                <div class="modal-dialog" style="width: 500px;">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"
                                                style="font-weight: bold;text-align: center;border-bottom: 2px solid #222222;font-size: 23px;">
                                                Danh Sách Người Chọn <?= $answers[$i] ?></h4>
                                        </div>
                                        <div class="modal-body dataShow<?= $value->question_id . $i ?>"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <div style="clear: both"></div>
                            <?php $answer = explode(',', $value->answer);
                            $dem = 0;
                            for ($j = 0; $j < count($answer); $j++) {
                                if ($answers[$i] == $answer[$j]) {
                                    $dem++;
                                }
                            }
                            $statis = ($dem / $dataS->count) * 100;
                            $statis = round($statis, 2);
                            if ($statis != 0.0) { ?>
                                <div style="border-radius: 7px;color: white;font-weight: bold;height: 40px;line-height: 40px;width: <?php echo $statis; ?>%;background-color: #000088    ;text-align: center">
                                    <?= $statis; ?> %
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            <!--           End Checkbox - Radio - Select            -->
        </table>
    <?php } ?>
</fieldset>
<?php } ?>
<script>
    function abc(question_id, answer, displayD) {
        $.ajax({
            url: '<?= URL ?>surveys/viewdetail?qid=' + question_id + '&asr=' + answer,
            type: 'GET',
            success: function (res) {
                $('.dataShow' + displayD).html(res);
                console.log(res);
            }
        });
    }
</script>