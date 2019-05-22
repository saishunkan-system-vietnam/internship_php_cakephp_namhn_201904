<?php if ($HgNam[1] == "Admin") { ?>
<fieldset class="col-md-12">
    <legend>Danh Sách Khảo Sát</legend>
    <table class="table table-hover table-bordered">
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Khảo Sát</th>
            <th>Danh Mục</th>
            <th>Bắt Đầu</th>
            <th>Kết Thúc</th>
            <th>Đăng Nhập</th>
            <th>Số Lượng</th>
            <th>Đóng/Mở<br>Khảo Sát</th>
            <th>Hiển Thị</th>
            <th>Khởi Tạo</th>
            <th>Chỉnh Sửa</th>
            <th style="text-align: center">
                <a href="<?= URL ?>surveys/add" class="btn btn-success">
                    <i class="fas fa-plus"></i> ADD
                </a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td>
                    <img style="width: 150px;height: 100px;" src="<?= URL ?>img/survey/<?= $value->img_survey?>" alt="">
                </td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value['Catalogs']['name'] ?></td>
                <td><?php echo $value->start_time ?></td>
                <td><?php echo $value->end_time ?></td>
                <td style="text-align: center">
                    <?php if ($value->login_status == 'on') { ?>
                        <i class="glyphicon glyphicon-check" style="font-size: 30px;"></i>
                    <?php } else { ?>
                        <i class="glyphicon glyphicon-unchecked" style="font-size: 30px;"></i>
                    <?php } ?>
                </td>
                <td><?php echo $value->count ?> | <?php echo $value->maximum ?></td>
                <?php if ($value->status == "open") { ?>
                    <td><i style="font-size: 30px;" class="fas fa-door-open"></i></td>
                <?php } ?>
                <?php if ($value->status == "closed") { ?>
                    <td><i style="font-size: 30px;" class="fas fa-door-closed"></i></td>
                <?php } ?>
                <td>
                    <?php if ($value->hot == 1) {?>
                        <i style="font-size: 30px;" class="fas fa-check"></i>
                    <?php } ?>
                </td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td style="width: 270px;text-align: center">
                    <a href="<?= URL ?>surveys/edit/<?php echo $value->id ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a onClick="return confirm('Bạn Thật Sự Muốn <?= $value->name ?>?')" href="<?= URL ?>surveys/delete/<?php echo $value->id ?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i> Delete</a>
                    </a> <br>
                    <a style="margin-top: 10px;" href="<?= URL ?>surveys/view/<?php echo $value->id ?>"
                       class="btn btn-warning">
                        <i class="far fa-eye"></i></i> Views</a>
                    </a>
                    <a style="margin-top: 10px;" href="<?= URL ?>surveys/statist/<?php echo $value->id ?>"
                       class="btn btn-info">
                        <i class="fas fa-torah"></i> Statist</a>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev('« Previous ');
        echo $this->Paginator->numbers();
        echo $this->Paginator->next(' Next »');
        ?>
    </ul>
</fieldset>
<?php }?>