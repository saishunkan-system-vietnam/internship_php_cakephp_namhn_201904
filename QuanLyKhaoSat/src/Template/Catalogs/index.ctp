<?php if ($HgNam[1] == "Admin") { ?>
    <fieldset class="col-md-10 col-md-offset-1">
        <legend>
            Danh Sách Danh Mục Khảo Sát
        </legend>
        <table class="table table-bordered table-striped">
            <tr  style="background-color: #333333;color: white">
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Thời Gian Khởi Tạo</th>
                <th>Thời Gian Thay Đổi</th>
                <th style="text-align: center">
                    <a href="<?= URL ?>catalogs/add" class="btn btn-success">
                        <i class="fas fa-plus"></i> ADD
                    </a>
                </th>
            </tr>
            <?php foreach ($data as $value) { ?>
                <tr>
                    <th><?php echo $value->id ?></th>
                    <th><?php echo $value->name ?></th>
                    <th><?php echo $value->created ?></th>
                    <th><?php echo $value->modified ?></th>
                    <th style="text-align: center">
                        <a href="<?= URL ?>catalogs/edit/<?php echo $value->id ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button id="<?php echo $value->id ?>" type="button" class="btn btn-danger click">
                            <i class="far fa-trash-alt"></i> Delete</a>
                        </button>
                        </a>
                        <a href="<?= URL ?>catalogs/lists/<?php echo $value->id ?>" class="btn btn-warning">
                            <i class="fas fa-list-ul"></i> List</a>
                        </a>
                    </th>
                </tr>
            <?php } ?>
        </table>
        <?php if ($dem > 8) {?>
        <ul class="pagination">
            <?php
            echo $this->Paginator->prev('« Previous ');
            echo $this->Paginator->numbers();
            echo $this->Paginator->next(' Next »');
            ?>
        </ul>
        <?php }?>
        <style>
            #recycleBin {
                float: left;
                margin-top: 20px;
                line-height: 45px;
                width: 140px;
                font-size: 18px;
                background-color: #00868B;color: white;
                font-weight: bold;
            } #recycleBin:hover{
                  background-color: #cccccc;color: black;
              }
        </style>
        <?php if (!empty($recycleBin)) {?>
        <button class="pull-right" id="recycleBin"
                type="button" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-trash-alt"></i> Recycle Bin
        </button>
        <?php }?>
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
                                <th>Danh Mục</th>
                                <th></th>
                            </tr>
                            <?php foreach ($recycleBin as $value) { ?>
                                <tr class="recycleBin<?= $value->id ?>">
                                    <th><?= $value->name ?></th>
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
<?php } ?>
<script type="text/javascript">
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
                            url: '<?= URL ?>catalogs/clickDelete?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Xóa Thành Công !", {
                                        icon: "success",
                                    }).then(function () {
                                        window.location.replace("<?= URL ?>catalogs");

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
                            url: '<?= URL ?>catalogs/delete?id=' + id,
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
                            url: '<?= URL ?>catalogs/restore?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Khôi Phục Thành Công !", {
                                        icon: "success",
                                    }).then(function () {
                                        window.location.replace("<?= URL ?>catalogs");
                                    })
                                }
                                // Mình đang xây dựng theo hướng dùng ajax thêm bản ghi vào dòng cuối nhưng sẽ k hợp lý vì nó vướng với phân trang
                                // $('.recycleBin' + id).remove();
                                //$.ajax({
                                //    url: '<?//= URL ?>//users/addrestore?id=' + id,
                                //    type: 'GET',
                                //    success: function (res) {
                                //        $('.addRestore').html(res);
                                //        console.log(res);
                                //    }
                                //});
                            }
                        });
                    }
                });
        });
    });
</script>

