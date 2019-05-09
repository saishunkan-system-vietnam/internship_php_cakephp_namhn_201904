<fieldset class="col-lg-12">
    <legend>
        Chỉnh Sửa Khảo Sát
    </legend>
    <form action="<?= URL ?>surveys/edit/<?php echo $data->id ?>" method="post" id="formSurveys">
        <table class="table">
            <tr>
                <th>Danh mục khảo sát</th>
                <th>
                    <select class="form-control" name="catalog_id">
                        <option value="<?php echo $catalog->id; ?>"><?php echo $catalog->name; ?></option>
                        <?php foreach ($select as $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                        <?php } ?>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Tên Khảo Sát</th>
                <th><input value="<?php echo isset($result[0]) ? $result[0] : $data->name ?>"
                           type="text" name="name" class="form-control"></th>
            </tr>
            <tr>
                <th>Trạng Thái Đăng Nhập</th>
                <th>
                    <?php if ($data->login_status == 'on') { ?>
                        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="danger">Check</button>
                            <input type="checkbox" class="hidden" name="login_status" checked/>
                        </span>
                    <?php } ?>
                    <?php if ($data->login_status == '') { ?>
                        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="danger">Check</button>
                            <input type="checkbox" class="hidden" name="login_status"/>
                        </span>
                    <?php } ?>

                </th>
            </tr>
            <tr>
                <th>
                    <span>Ngày Bắt Đầu Khảo Sát :</span>
                </th>
                <th>
                    <input class="form-control" type="date" name="start_time" value="<?php echo $data->start_time ?>">
                </th>
            </tr>
            <tr>
                <th>
                    Ngày Kết Thúc Khảo Sát :
                </th>
                <th>
                    <input class="form-control" name="end_time" value="<?php echo $data->end_time ?>" type="date">
                </th>
            </tr>
            <tr>
                <th>
                    Số Khảo Sát Tối Đa :
                </th>
                <th>
                    <input type="number" class="form-control" name="maximum"
                           value="<?php echo isset($result[5]) ? $result[5] : $data->maximum ?>">
                </th>
            </tr>
        </table>
        <fieldset class="col-lg-12">
            <legend>
                Danh Sách Câu Hỏi
                <a href="<?= URL ?>questions/add/<?php echo $data->id ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Thêm Câu Hỏi</a>
                <a href="<?= URL ?>surveys/view/<?php echo $data->id ?>" class="btn btn-warning">
                    <i class="far fa-eye"></i></i> View</a>
            </legend>
            <table class="table">
                <tr>
                    <th>Type Ques</th>
                    <th>Question</th>
                    <th>Answers</th>
                    <th>Type Answ</th>
                    <th style="width: 180px;"></th>
                </tr>
                <?php foreach ($data2

                as $value) { ?>
                <tr>
                    <td><?php echo $value->type_question ?></td>
                    <?php if ($value->type_question == 'Images') { ?>
                        <td><img style="height: 100px;width: 200px;" src="<?= URL ?>img/<?= $value->name ?>"></td>
                    <?php } else { ?>
                        <td><?php echo $value->name ?></td>
                    <?php } ?>
                    <td><?php echo $value->answers ?></td>
                    <td><?php echo $value->type_answer ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= URL ?>questions/edit/<?php echo $value->id ?>">
                            <i class="fas fa-edit"></i> Write
                        </a>
                        <a class="btn btn-danger" href="<?= URL ?>questions/delete/<?php echo $value->id ?>">
                            <i class="far fa-trash-alt"></i> Delete</a>
                        </a>
                    </td>
                <tr>
                    <?php } ?>
            </table>
        </fieldset>
        <div class="pull-right" style="margin: 20px;">
            <button style="width: 120px;height: 40px;font-size: 18px;" class="btn btn-primary" type="submit"><i
                        class="far fa-thumbs-up"></i> Submit
            </button>
            <button style="width: 120px;height: 40px;font-size: 18px;margin-right: 400px;" class="btn btn-danger"
                    type="reset"><i class="fas fa-sync-alt"></i> Reset
            </button>
        </div>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/surveys'); ?>

<?php echo $this->Html->script('checkbox.js'); ?>


