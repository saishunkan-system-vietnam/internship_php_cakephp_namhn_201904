<?php echo $this->Html->css('HNam'); ?>
<fieldset class="col-lg-12">
    <legend>
        Khởi Tạo Khảo Sát
    </legend>
    <form action="<?= SITE_URL ?>surveys/edit/<?php echo $data->id ?>" method="post">
        <table>
            <tr>
                <th>Danh mục khảo sát</th>
                <th>
                    <select class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th>Tên Khảo Sát</th>
                <th><input value="<?php echo isset($result[0]) ? $result[0] : $data->name ?>"
                           type="text" class="form-control"></th>
            </tr>
            <tr>
                <th>Trạng Thái Đăng Nhập</th>
                <th>
                    <?php if ($data->login_status == 'yes') { ?>
                        <label>
                            <input type="checkbox" checked="checked"/>
                            <span>Yes</span>
                        </label>
                    <?php } ?>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <?php if ($data->login_status == 'no') { ?>
                        <label>
                            <input type="checkbox" checked="checked"/>
                            <span>No</span>
                        </label>
                    <?php } ?>

                </th>
            </tr>
            <tr>
                <th>
                    <span>Ngày Bắt Đầu Khảo Sát :</span>
                </th>
                <th>
                    <input type="date" value="<?php echo $data->start_time ?>">
                </th>
            </tr>
            <tr>
                <th>
                    Ngày Kết Thúc Khảo Sát :
                </th>
                <th>
                    <input type="date">
                </th>
            </tr>
            <tr>
                <th>
                    Số Khảo Sát Tối Đa :
                </th>
                <th>
                    <input type="name" class="form-control"
                           value="<?php echo isset($result[5]) ? $result[5] : $data->maximum ?>">
                </th>
            </tr>
            <tr>
                <th>
                    <button class="btn">
                        <a  href="<?= SITE_URL ?>surveys/qadd">
                            Thêm Câu Hỏi

                        </a>
                    </button>
                </th>
            </tr>
        </table>
        <fieldset class="col-lg-10 col-lg-offset-1">
            <legend>
                Danh Sách Câu Hỏi
            </legend>
            <table>
                <?php foreach ($data2 as $value) { ?>
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
                        <input
                               type="submit"
                               name="submit"
                               value="Submit" class="btn">
                        <input
                               type="reset"
                               value="Reset"
                               class="btn">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</fieldset>