<?php echo $this->Html->css('haizzz'); ?>
<fieldset class="col-lg-12">
    <legend>
        Khởi Tạo Khảo Sát
    </legend>
    <form action="<?= SITE_URL ?>surveys/edit/<?php echo $data->id ?>" method="post">
        <table>
            <tr>
                <th>Danh mục khảo sát</th>
                <th>
                    <select class="form-control" name="catalog_id">
                        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
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
                    <a href="<?= SITE_URL ?>surveys/qadd">
                        Thêm Câu Hỏi
                    </a>
                </th>
            </tr>
        </table>
        <fieldset class="col-lg-10 col-lg-offset-1">
            <legend>
                Danh Sách Câu Hỏi
            </legend>
            <table>
                <?php foreach ($data2

                as $value) { ?>
                <tr>
                    <th>Câu hỏi Số :</th>
                    <th><?php echo $value->name ?></th>
                    <th>
                        <button>
                            <a href="">Edit</a>
                        </button>
                        <button>
                            <a href="">Delete</a>
                        </button>
                    </th>
                <tr>
                    <?php } ?>
                    <th></th>
                    <td>
                        <button class="sub" type="submit">Submit</button>
                        <button class="sub" type="reset">Reset</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</fieldset>