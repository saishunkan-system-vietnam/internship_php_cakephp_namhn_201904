<style>
    tr {
        height: 50px;
    }
</style>
<fieldset class="col-md-12">
    <legend>Danh Sách Users</legend>
    <table class="table table-bordered table-striped">
        <tr style="background-color: #333333;color: white;">
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
                <a href="<?php URL ?>users/add" class="btn btn-success">
                    <i class="fas fa-plus"></i> ADD
                </a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr class="rows<?= $value->id ?> recycleBin<?= $value->id ?>">
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
                    <?php if ($value->id == $HgNam[2] || $value->level == "Member") { ?>
                        <?php if ($value->id == $HgNam[2]) {?>
                        <a href="<?php URL ?>users/edit/<?php echo $value->id ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <?php } ?>
                        <button type="button" id="<?= $value->id ?>" class="btn btn-danger click">
                            <i class="far fa-trash-alt"></i> Delete
                        </button>
                        <button class="btn btn-info" onclick="groupUsers('<?= $value->id?>')"  type="button" data-toggle="modal" data-target="#groupUsers<?= $value->id ?>">
                            <i class="far fa-object-group"></i> Group
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="groupUsers<?= $value->id ?>" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><u>Nhóm Tham Gia</u></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="showGroups"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        <tr class="addRestore"></tr>
    </table>
    <?php if ($dem > 6) { ?>
        <ul class="pagination" style="float: left">
            <?php
            echo $this->Paginator->prev('« Previous ');
            echo $this->Paginator->numbers();
            echo $this->Paginator->next(' Next »');
            ?>
        </ul>
    <?php } ?>
    <style>
        #recycleBin {
            float: left;
            margin-top: 20px;
            line-height: 45px;
            width: 140px;
            font-size: 18px;
            background-color: #00868B;
            color: white;
            font-weight: bold;
        }

        #recycleBin:hover {
            background-color: #cccccc;
            color: black;
        }
    </style>
    <?php if (!empty($recycleBin)) { ?>
        <button class="pull-right" id="recycleBin"
                type="button" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-trash-alt"></i> Recycle Bin
        </button>
    <?php } ?>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-weight: bold;font-size: 25px;text-align: center">Recycle
                        Bin</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Tài Khoản</th>
                            <th>Họ và Tên</th>
                            <th style="width: 250px;"></th>
                        </tr>
                        <?php foreach ($recycleBin as $value) { ?>
                            <tr class="recycleBin<?= $value->id ?>">
                                <th><?= $value->email ?></th>
                                <th><?= $value->fullname ?></th>
                                <th>
                                    <button class="btn btn-primary restore" id="<?= $value->id ?>"
                                            style="width: 90px;height: 40px;"><i class="fas fa-undo-alt"></i> Restore
                                    </button>
                                    <button class="btn btn-danger clickDelete" id="<?= $value->id ?>"
                                            style="width: 90px;height: 40px;"><i class="fas fa-user-minus"></i> Delete
                                    </button>
                                </th>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button style="background-color:#C0C0C0;color: black;font-weight: bold;width: 100px;height: 45px;"
                            type="button" data-dismiss="modal"><i class="fas fa-door-closed"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
</fieldset>
<script type="text/javascript">
    function groupUsers(id){
        $.ajax({
            url: '<?= URL ?>users/groupUsers?id=' + id,
            type: 'GET',
            success: function (res) {
                $('.showGroups').html(res);
                console.log(res);
            }
        });
    };
    $(document).ready(function () {
        // Đưa bản ghi vào thùng rác
        $(".click").click(function () {
            let id = $(this).attr("id");
            swal({
                title: "Bạn Có Chắc Muốn Xóa Không?",
                text: "Sau khi xóa dữ liệu sẽ được chuyển tới Thùng Rác!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?= URL ?>users/clickDelete?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Xóa Thành Công !", {
                                        icon: "success",
                                    }).then(function () {
                                        <?php if ($dem % 6 == 1 && $page == $total) { ?>
                                        window.location.replace("<?= URL ?>users?page=<?= ($page - 1)?>");
                                        <?php } else {?>
                                        location.reload();
                                        <?php }?>
                                    });
                                }
                            }
                        })
                    }
                });
        });
        // Xóa Hoàn Toàn Bản ghi
        $(".clickDelete").click(function () {
            let id = $(this).attr("id");
            swal({
                title: "Bạn Có Chắc Muốn Xóa Không?",
                text: "Sau khi xóa dữ liệu sẽ không được khôi phục lại!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?= URL ?>users/delete?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Xóa Thành Công !", {
                                        icon: "success",
                                    })
                                }
                                $('.recycleBin' + id).remove();
                            }
                        });
                    }
                });
        });
        // Khôi Phục Bản Ghi Đã Xóa
        $(".restore").click(function () {
            let id = $(this).attr("id");
            swal({
                title: "Bạn Có Chắc Muốn Khôi Phục Không?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?= URL ?>users/restore?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Khôi Phục Thành Công !", {
                                        icon: "success",
                                    }).then(function () {
                                        window.location.replace("<?= URL ?>users");
                                    })
                                }
                            }
                        });
                    }
                });
        });
    });
</script>

