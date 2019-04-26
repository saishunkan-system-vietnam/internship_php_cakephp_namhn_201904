<?php echo $this->Html->css('haizzz'); ?>
<fieldset class="col-lg-12" style="margin-top: 130px;">
    <legend>
        Khởi Tạo Khảo Sát
    </legend>
    <form method="post" action="">
        <table>
            <tr>
                <th>Danh mục khảo sát</th>
                <th>
                    <select class="form-control" name="catalog_id">
                        <?php foreach ($catalog as $value) { ?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->name; ?></option>
                        <?php } ?>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Tên Khảo Sát</th>
                <th><input type="text" name="name" class="form-control"></th>
            </tr>
            <tr>
                <th>Trạng Thái Đăng Nhập</th>
                <td>
                    <label>
                        <input type="checkbox" name="login_status" class="filled-in" checked="checked" />
                        <span></span>
                    </label>
                </td>
            </tr>
            <tr>
                <th>
                    <span>Ngày Bắt Đầu Khảo Sát :</span>
                </th>
                <th>
                    <input type="date" name="start_time">
                </th>
            </tr>
            <tr>
                <th>
                    Ngày Kết Thúc Khảo Sát :
                </th>
                <th>
                    <input type="date" name="end_time">
                </th>
            </tr>
            <tr>
                <th>
                    Số Khảo Sát Tối Đa :
                </th>
                <th>
                    <input type="number" name="maximum" class="form-control">
                </th>
            </tr>
            <tr>
                <th></th>
                <th>
                    <a href="<?= SITE_URL ?>surveys/quesadd">
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
                <tr>
                    <th>Câu Hỏi Số</th>
                    <td></td>
                <tr>
                    <th></th>
                    <td>
                        <button class="sub" type="submit">Submit</button>
                        <button class="sub" type="reset">Reset</button>
                    </td>
                </tr>
                </tr>
            </table>
        </fieldset>
    </form>
</fieldset>
