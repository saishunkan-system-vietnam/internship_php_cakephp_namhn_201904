<fieldset class="col-lg-12">
    <legend>
        Chỉnh Sửa Khảo Sát
    </legend>
    <form action="<?= URL ?>surveys/edit/<?php echo $data->id ?>" method="post" id="formSurveys">
        <table>
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
                        <label>
                            <input name="login_status" type="checkbox" checked="checked"/>
                            <span></span>
                        </label>
                    <?php } ?>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <?php if ($data->login_status == '') { ?>
                        <label>
                            <input name="login_status" type="checkbox"/>
                            <span></span>
                        </label>
                    <?php } ?>

                </th>
            </tr>
            <tr>
                <th>
                    <span>Ngày Bắt Đầu Khảo Sát :</span>
                </th>
                <th>
                    <input type="date" name="start_time" value="<?php echo $data->start_time ?>">
                </th>
            </tr>
            <tr>
                <th>
                    Ngày Kết Thúc Khảo Sát :
                </th>
                <th>
                    <input name="end_time" value="<?php echo $data->end_time ?>" type="date">
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
            <tr>
                <th></th>
                <th>
                    <a href="<?= URL ?>questions/add/<?php echo $data->id ?>" class="btn">
                        Thêm câu hỏi
                    </a>
                    <a href="<?= URL ?>surveys/listq/<?php echo $data->id ?>" class="btn">Views</a>
                </th>
            </tr>
        </table>
        <fieldset class="col-lg-12">
            <legend>
                Danh Sách Câu Hỏi
            </legend>
            <table>
                <tr>
                    <th class="col-lg-4">Question</th>
                    <th class="col-lg-4">Answers</th>
                    <th class="col-lg-2" style="text-align: center">Type</th>
                    <th class="col-lg-2"></th>
                </tr>
                <?php foreach ($data2 as $value) { ?>
                <tr>
                    <td><?php echo $value->name ?></td>
                    <td><?php echo $value->answers ?></td>
                    <td style="text-align: center"><?php echo $value->type_answer ?></td>
                    <td>
                        <a class="btn" href="<?= URL ?>questions/edit/<?php echo $value->id ?>">
                            Edit
                        </a>
                        <a class="btn" href="<?= URL ?>questions/delete/<?php echo $value->id ?>">
                            Delete
                        </a>
                    </td>
                <tr>
                    <?php } ?>
                <tr>
                    <th></th>
                    <th>
                        <button class="button" type="submit">Submit</button>
                        <button class="button" type="reset">Reset</button>
                    </th>
                </tr>
            </table>
        </fieldset>
    </form>
</fieldset>
<?php echo $this->Html->script('validate/surveys'); ?>