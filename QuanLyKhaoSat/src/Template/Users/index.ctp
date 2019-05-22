<?php if ($HgNam[1] == "Admin") { ?>
    <fieldset class="col-md-12">
        <legend>Danh Sách Users</legend>
        <table class="table table-hover table-bordered">
            <tr>
                <th>ID</th>
                <th>Tài Khoản</th>
                <th>Họ và Tên</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Ngày Sinh</th>
                <th>Chức Vụ</th>
                <th>Câu Hỏi Bí Mật</th>
                <th>Câu Trả Lời</th>
                <th>Khởi Tạo</th>
                <th>Chỉnh Sửa</th>
                <th>
                    <?php if ($HgNam[1] == "Admin") { ?>
                        <a href="<?php URL ?>users/add" class="btn btn-success">
                            <i class="fas fa-plus"></i> ADD
                        </a>
                    <?php } ?>
                </th>
            </tr>
            <?php foreach ($data as $value) { ?>
                <tr>
                    <td><?php echo $value->id ?></td>
                    <td><?php echo $value->email ?></td>
                    <td><?php echo $value->fullname ?></td>
                    <td><?php echo $value->address ?></td>
                    <td><?php echo $value->phone ?></td>
                    <td><?php echo $value->birth ?></td>
                    <td><?php echo $value->level ?></td>
                    <td><?php echo $value->secret_q ?></td>
                    <td><?php echo $value->secret_a ?></td>
                    <td><?php echo $value->created ?></td>
                    <td><?php echo $value->modified ?></td>
                    <td>
                        <?php if (($HgNam[1] == 'Admin' && $value->level == 'Member') || ($HgNam[1] == 'Admin' && $value->id == $HgNam[2]) || ($HgNam[1] == 'Member' && $value->id == $HgNam[2])) { ?>
                            <a href="<?php URL ?>users/edit/<?php echo $value->id ?>" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a onClick="return confirm('Bạn Thật Sự Muốn Xóa Tài Khoản <?= $value->email ?>?')" class="btn btn-danger"
                               href="<?php URL ?>users/delete/<?php echo $value->id ?>">
                                <i class="far fa-trash-alt"></i> Delete</a>
                        <?php } ?>
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
<?php } ?>
