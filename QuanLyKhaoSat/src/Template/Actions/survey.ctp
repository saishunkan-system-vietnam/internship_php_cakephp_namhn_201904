<style>
    button {
        background-color: #222222;
        color: white;
        height: 50px;
        width: 180px;
        border-radius: 5px;
        color: white;
        font-size: 20px;
    }

    button:hover {
        background-color: #0071BC;
    }
</style>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<?php if (($dataSurvey->maximum != '' && $dataSurvey->count >= $dataSurvey->maximum) || $dataSurvey->status == "closed" || ($dataSurvey->end_time != '' && strtotime($dataSurvey->end_time) < strtotime(date('Y-m-d H:i:s')))) { ?>
    <fieldset class="col-lg-6 col-lg-offset-3" style="margin-top: 40px;">
        <legend style="border: none;height: 40px;width: 200px;line-height: 40px;font-weight: bold;font-size: 30px;">
            [ Thông Báo ]
        </legend>
        <table class="table table-bordered">
            <tr>
                <th style="text-align: center;font-size: 25px;">Khảo Sát <?= $dataSurvey->name; ?> Đã Kết Thúc</th>
            </tr>
            <tr>
                <th style="text-align: center;font-size: 25px;border-bottom: 1px solid #DDDDDD">Xin Trận Thành
                    Cảm
                    Ơn ^^!
                </th>
            </tr>
        </table>
        <div>
            <a style="margin-bottom: 10px;" class="pull-right" href="<?= URL ?>actions">
                <button type="button" style="font-weight: bold">Back To Home</button>
            </a>
        </div>
    </fieldset>
<?php } else { ?>
    <?php if (isset($link) && $link == 'actions/survey/' . $dataSurvey->id) { ?>
        <fieldset class="col-lg-6 col-lg-offset-3" style="margin-top: 40px;">
            <legend style="border: none;height: 40px;width: 200px;line-height: 40px;font-weight: bold;font-size: 30px;">
                [ Thông Báo ]
            </legend>
            <table class="table table-bordered">
                <tr>
                    <th style="text-align: center;font-size: 25px;">Bạn Đã Hoàn Thành Khảo
                        Sát <?= $dataSurvey->name; ?></th>
                </tr>
                <tr>
                    <th style="text-align: center;font-size: 25px;border-bottom: 1px solid #DDDDDD">Xin Trận Thành
                        Cảm
                        Ơn ^^!
                    </th>
                </tr>
            </table>
            <div>
                <a style="margin-bottom: 10px;" class="pull-right" href="<?= URL ?>actions">
                    <button type="button" style="font-weight: bold">Back To Home</button>
                </a>
            </div>
        </fieldset>
    <?php } else { ?>
        <form enctype="multipart/form-data" id="KhaoSat" method="post" action="<?= URL ?>actions/survey/<?= $dataSurvey->id ?>">
            <fieldset class="col-md-6 col-md-offset-3" style="font-size: 20px;">
                <tr>
                    <td>
                        <blockquote>
                            <i><u>Lưu Ý :</u></i>
                            <footer style="font-size: 18px;">Câu Hỏi Chứa Dấu <span style="color: red">( * )</span> Bắt Buộc Bạn Phải Trả Lời</footer>
                        </blockquote>
                    </td>
                </tr>
                <?php if (isset($resultError)) {?>
                    <h1>Error</h1>
                <?php }?>
                <legend><?php echo $dataSurvey->name ?></legend>
                <table class="table table-hover">
                    <?php if (empty($dataQuestion)) { ?>
                        <tr>
                            <th style="text-align: center;color: red;font-size: 25px;">Khảo Sát Đang Được Xây Dựng,
                                Xin
                                Vui Lòng
                                Quay Lại Sau
                            </th>
                        </tr>
                        <tr>
                            <th class="pull-right"><a href="<?= URL ?>actions">
                                    <button class="btn btn-primary"
                                            style="width: 180px;height: 45px;line-height:10px;font-size: 20px;"
                                            type="button">
                                        Back To Home
                                    </button>
                                </a></th>
                        </tr>
                    <?php } ?>
                    <?php foreach ($dataQuestion as $key => $value) { ?>
                        <?php if ($value->type_question == "Text") { ?>
                            <tr>
                                <th style="font-size: 20px;">Câu hỏi
                                    số <?php echo $key + 1 ?> <?php if ($value->status == 'yes') { ?>
                                        <span style="color: red;">( * )</span>
                                    <?php } ?> : <?php echo $value->name ?></th>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <th>Câu hỏi số <?php echo $key + 1 ?> : <img
                                            src="<?= URL ?>img/<?php echo $value->name ?>"
                                            style="width: 150px;height: 100px;"></th>
                            </tr>
                        <?php } ?>
                        <!--=================Nếu type_answer = radio ======================-->
                        <?php if ($value->type_answer == "Radio") { ?>
                            <?php $answers = $value->answers;
                            $answers = explode(',', $answers);
                            $answers = array_unique($answers);
                            for ($i = 0; $i < count($answers); $i++) { ?>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="radio" value="<?php echo $answers[$i] ?>"
                                                   name="answers<?php echo $value->id ?>"
                                                   data-error="#err<?= $value->id ?>">
                                            <span style="color: black"><?php echo $answers[$i] ?></span>
                                        </label>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th><span id="err<?= $value->id ?>"></span></th>
                            </tr>
                        <?php } ?>
                        <!--=============End type_answer = Radio =====================-->
                        <!--=================Nếu type_answer = Select ======================-->
                        <?php if ($value->type_answer == "Select") { ?>
                            <?php $answers = $value->answers;
                            $answers = explode(',', $answers);
                            $answers = array_unique($answers);?>
                            <tr>
                                <td>
                                    <select name="answers<?php echo $value->id ?>"
                                            style="font-weight: bold;border-radius: 5px;height: 40px;width: 100%;"
                                            data-error="#err<?= $value->id ?>"
                                            id="select<?= $value->status ?>" class="form-control">
                                        <option value="">Vui lòng chọn đáp án</option>
                                        <?php for ($i = 0; $i < count($answers); $i++) { ?>
                                            <option value="<?php echo $answers[$i] ?>">
                                        <span>
                                           <?php echo $answers[$i] ?>
                                        </span>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><span id="err<?= $value->id ?>"></span></th>
                            </tr>
                        <?php } ?>
                        <!--=================End type_answer = Select ======================-->
                        <!--================= Nếu type_answer = Text ======================-->
                        <?php if ($value->type_answer == "Text") { ?>
                            <tr>
                                <td>
                                    <input type="<?php echo $value->type_answer ?>"
                                           name="answers<?php echo $value->id ?>"
                                           data-error="#err<?= $value->id ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th><span id="err<?= $value->id ?>"></span></th>
                            </tr>
                        <?php } ?>
                        <!--=================End type_answer = Text ======================-->
                        <!--================= Nếu type_answer = Text ======================-->
                        <?php if ($value->type_answer == "TextArea") { ?>
                            <tr>
                                <td>
                            <textarea data-error="#err<?= $value->id ?>" style="width: 100%;" rows="4"
                                      name="answers<?php echo $value->id ?>"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><span id="err<?= $value->id ?>"></span></th>
                            </tr>
                        <?php } ?>
                        <!--=================End type_answer = select ======================-->
                        <!--=================Nếu type_answer = Checkbox======================-->
                        <?php if ($value->type_answer == "Checkbox") { ?>
                            <?php $answers = $value->answers;
                            $answers = explode(',', $answers);
                            $answers = array_unique($answers);
                            for ($i = 0; $i < count($answers); $i++) { ?>
                                <tr>
                                    <td>
                                        <label>
                                            <input <input class="<?= $value->status ?><?= $value->id ?>"
                                                          type="checkbox"
                                                          name="answers<?php echo $value->id ?>[]"
                                                          value="<?php echo $answers[$i] ?>"
                                                          data-error="#err<?= $value->id ?>"/>
                                            <span style="color: black"><?php echo $answers[$i] ?></span>
                                        </label>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th><span id="err<?= $value->id ?>"></span></th>
                            </tr>
                        <?php } ?>
                        <!--=============End type_answer =  Checkbox=====================-->
                        <!--================= Nếu type_answer = Images ======================-->
                        <?php if ($value->type_answer == "Images") { ?>
                            <tr>
                                <th><input type="file" name="answers<?php echo $value->id ?>"></th>
                            </tr>
                        <?php } ?>
                        <!--=================End type_answer = Images ======================-->
                    <?php } ?>
                    <?php if (!empty($dataQuestion)) { ?>
                        <tr>
                            <th>
                                <button type="submit"
                                        style="width: 170px;height: 44px;line-height: 30px;font-size: 16px;"
                                        class="pull-right btn btn-danger">
                                    <i class="fas fa-thumbs-up"></i> Hoàn Thành
                                </button>
                            </th>
                        </tr>
                    <?php } ?>
                </table>
            </fieldset>
        </form>
        <script>
            $(document).ready(function () {
                $("#KhaoSat").validate({
                    rules: {
                        <?php foreach ($dataQuestion as $key => $value) {
                        if ($value->status == "yes") { ?>
                        answers<?= $value->id ?>: "required",
                        'answers<?= $value->id ?>[]': "required",
                        <?php }} ?>
                    },
                    messages: {
                        <?php foreach ($dataQuestion as $key => $value) {
                        if ($value->status == "yes") { ?>
                        answers<?= $value->id ?>: "BẠN CẦN PHẢI TRẢ LỜI CÂU HỎI NÀY ^^! XIN CẢM ƠN !",
                        'answers<?= $value->id ?>[]': "BẠN CẦN PHẢI TRẢ LỜI CÂU HỎI NÀY ^^! XIN CẢM ƠN !",
                        <?php }} ?>
                    },
                    errorPlacement: function (error, element) {
                        var placement = $(element).data('error');
                        if (placement) {
                            $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
            })
        </script>
    <?php }
} ?>
