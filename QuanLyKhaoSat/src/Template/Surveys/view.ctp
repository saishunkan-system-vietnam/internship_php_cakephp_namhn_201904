<style>
    select:hover {
        cursor: pointer;
    }

    .dlk-radio input[type="radio"],
    .dlk-radio input[type="checkbox"] {
        margin-left: -99999px;
        display: none;
    }

    .dlk-radio input[type="radio"] + .fa,
    .dlk-radio input[type="checkbox"] + .fa {
        opacity: 0.2
    }

    .dlk-radio input[type="radio"]:checked + .fa,
    .dlk-radio input[type="checkbox"]:checked + .fa {
        opacity: 1
    }

    th {
        text-align: left;
    }

    td {
        text-align: left;
    }
</style>
<form>
    <fieldset class="col-md-8 col-md-offset-2">
        <legend><?php echo $dataS->name ?></legend>
        <table class="table table-hover">
            <?php foreach ($data as $key => $value) { ?>
                <?php if ($value->type_question == "Text") { ?>
                    <tr>
                        <th style="font-size: 19px;">Câu hỏi số <?php echo $key + 1 ?> : <?php echo $value->name ?></th>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <th>Câu hỏi số <?php echo $key + 1 ?> : <img src="<?= URL ?>img/<?php echo $value->name ?>"
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
                                <label class="radio"><?php echo $answers[$i] ?>
                                    <input type="radio" value="<?php echo $answers[$i] ?>"
                                           name="answers<?php echo $value->id ?>">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <!--=============End type_answer = Radio =====================-->
                <!--=================Nếu type_answer = Checkbox======================-->
                <?php if ($value->type_answer == "Checkbox") { ?>
                    <?php $answers = $value->answers;
                    $answers = explode(',', $answers);
                    $answers = array_unique($answers);
                    for ($i = 0; $i < count($answers); $i++) { ?>
                        <tr>
                            <td>
                                <span class="button-checkbox" style="font-weight: bold">
                                    <button type="button" class="btn" data-color="danger"></button>
                                      <input class="hidden" type="checkbox" name="answers<?php echo $value->id ?>[]"
                                             value="<?php echo $answers[$i] ?>"/>&nbsp <?php echo $answers[$i] ?>
                                 </span>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <!--=============End type_answer =  Checkbox=====================-->
                <!--=================Nếu type_answer = Select ======================-->
                <?php if ($value->type_answer == "Select") { ?>
                    <?php $answers = $value->answers;
                    $answers = explode(',', $answers);
                    $answers = array_unique($answers); ?>
                    <tr>
                        <td>
                            <select name="answers<?php echo $value->id ?>"
                                    style="font-weight: bold;border-radius: 5px;height: 40px;width: 100%">
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
                <?php } ?>
                <!--=================End type_answer = Select ======================-->
                <!--================= Nếu type_answer = Text ======================-->
                <?php if ($value->type_answer == "Text") { ?>
                    <tr>
                        <td>
                            <input type="<?= $value->answers ?>" id="<?= $value->answers ?>"
                                <?php if ($value->answers == "number") { ?>
                                    placeholder="Vui Lòng Nhập ' Số ' Bạn Trả Lời"
                                <?php } ?>
                                <?php if ($value->answers == "email") { ?>
                                    placeholder="Vui Lòng Nhập Email Bạn Trả Lời"
                                <?php } ?>
                                <?php if ($value->answers == "tel") { ?>
                                    placeholder="Vui Lòng Nhập Số Điện Thoại Viết Liền Không Khoảng Trống"
                                <?php } ?>
                                   style="width: 100%" type="<?php echo $value->type_answer ?>" class="form-control"
                                   name="answers<?php echo $value->id ?>">
                        </td>
                    </tr>
                <?php } ?>
                <!--=================End type_answer = select ======================-->
                <!--================= Nếu type_answer = Text ======================-->
                <?php if ($value->type_answer == "TextArea") { ?>
                    <tr>
                        <td>
                            <textarea style="width: 50%" rows="4" name="answers<?php echo $value->id ?>"></textarea>
                        </td>
                    </tr>
                <?php } ?>
                <!--=================End type_answer = select ======================-->
                <!--================= Nếu type_answer = Images ======================-->
                <?php if ($value->type_answer == "Images") { ?>
                    <tr>
                        <th><input type="file" name="answers<?php echo $value->id ?>"></th>
                    </tr>
                <?php } ?>
                <!--=================End type_answer = Images ======================-->
            <?php } ?>
            <tr>
                <th><a style="width: 150px;height: 44px;line-height: 30px;font-size: 16px;"
                       href="<?= URL ?>questions/add/<?php echo $dataS->id ?>" class="pull-right btn btn-danger">
                        <i class="fas fa-plus"></i> Thêm Câu Hỏi</a></th>
            </tr>
        </table>
    </fieldset>
</form>
<?php echo $this->Html->css('radio'); ?>
