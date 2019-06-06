<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<?php echo $this->Html->css('radio'); ?>
<?php if (empty($data)) { ?>
    <a href="<?= URL ?>surveys"><div style="color: red;font-weight: bold;font-size: 35px;margin-top: 50px;"><u>Đường Dẫn Này Không Tồn Tại</u></div></a>
<?php } else { ?>
    <style>
        th {
            text-align: left;
        }
    </style>
    <fieldset class="col-lg-8 col-lg-offset-2">
        <?php if (isset($error->name)) { ?>
            <div class="alert alert-danger">
                Khảo Sát đã tồn tại, xin vui lòng nhập Khảo Sát khác ^^! Nhớ nha :))
            </div>
        <?php } ?>
        <?php if (isset($errorTime)) { ?>
            <div class="alert alert-danger">
                Thời gian bạn nhập đã lỗi .
            </div>
        <?php } ?>
        <?php if (isset($errorImages)) { ?>
            <div class="alert alert-danger">
                File bạn tải lên không phải là ảnh ^^!
            </div>
        <?php } ?>
        <legend>Chỉnh Sửa Khảo Sát</legend>
        <form action="<?= URL ?>surveys/edit/<?php echo $data->id ?>" method="post" id="Surveys"
              enctype="multipart/form-data">
            <table class="table table-hover table-bordered">
                <tr>
                    <th class="col-md-3">Danh mục khảo sát</th>
                    <th colspan="2">
                        <select class="form-control" name="catalog_id" style="max-width: 500px;width: 500px;">
                            <option value="<?php echo $catalog->id; ?>"><?php echo $catalog->name; ?></option>
                            <?php foreach ($select as $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                            <?php } ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th class="col-md-3">Ảnh Khảo Sát</th>
                    <th colspan="2">
                        <input type="file" name="img">
                        <?php if (empty($data->img_survey)) { ?>
                            <img src="<?= URL ?>img/survey/noimage.jpg" style="height: 120px;width: 150px;">
                        <?php } else { ?>
                            <img src="<?= URL ?>img/survey/<?= $data->img_survey ?>"
                                 style="height: 120px;width: 150px;">
                        <?php } ?>
                    </th>
                </tr>
                <tr>
                    <th>Tên Khảo Sát</th>
                    <th colspan="2"><input value="<?php echo isset($result[0]) ? $result[0] : $data->name ?>"
                                           type="text" name="name" class="form-control"></th>
                </tr>
                <tr>
                    <th>Trạng Thái Đăng Nhập</th>
                    <th colspan="2" style="text-align: left">
                        <?php if ($data->login_status == 'on') { ?>
                            <span class="button-checkbox">
                            <button type="button" class="btn" data-color="danger">Login</button>
                            <input type="checkbox" class="hidden" name="login_status" checked/>
                        </span>
                        <?php } ?>
                        <?php if ($data->login_status == '') { ?>
                            <span class="button-checkbox">
                            <button type="button" class="btn" data-color="danger">Login</button>
                            <input type="checkbox" class="hidden" name="login_status"/>
                        </span>
                        <?php } ?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <span>Ngày Bắt Đầu Khảo Sát :</span>
                    </th>
                    <th colspan="2">
                        <input class="form-control" type="date" name="start_time"
                               value="<?php echo $data->start_time ?>">
                    </th>
                </tr>
                <tr>
                    <th>
                        Ngày Kết Thúc Khảo Sát :
                    </th>
                    <th colspan="2">
                        <input class="form-control" name="end_time" value="<?php echo $data->end_time ?>" type="date">
                    </th>
                </tr>
                <tr>
                    <th>
                        Số Khảo Sát Tối Đa :
                    </th>
                    <th colspan="2">
                        <input type="number" class="form-control" name="maximum"
                               value="<?php echo isset($result[5]) ? $result[5] : $data->maximum ?>">
                    </th>
                </tr>
                <tr>
                    <th>Link Khảo Sát :</th>
                    <th colspan="2"><input style="width: 500px;float: left" type="text" class="form-control"
                                           id="myInput"
                                           value="http://nam.com/internship_php_cakephp_namhn_201904/QuanLyKhaoSat/actions/survey/<?= $data->id ?>">
                        <i onclick="myFunction()" style="font-size: 18px;color: white;width: 50px;height: 40px;"
                           class="fas fa-copy btn btn-primary"></i>
                        <div style="clear: both"></div>
                    </th>
                </tr>
                <tr>
                    <th>Trạng Thái :</th>
                    <th colspan="2" style="text-align: left">
                        <label class="radio" style="float: left;">Mở Khảo Sát
                            <input type="radio" <?php if ($data->status == "open") {
                                echo 'checked';
                            } ?> value="open" name="status">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio" style="float: left;margin-top: 10px;margin-left: 50px">Đóng Khảo Sát
                            <input type="radio" <?php if ($data->status == "closed") {
                                echo 'checked';
                            } ?> value="closed" name="status">
                            <span class="checkmark"></span>
                        </label>
                    </th>
                </tr>
                <tr>
                    <th>Hiển Thị :</th>
                    <th colspan="2" style="text-align: left">
                        <label class="radio" style="float: left;">Hiển Thị
                            <input type="radio" <?php if ($data->hot == 1) {
                                echo 'checked';
                            } ?> value="1" name="hot">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio" style="float: left;margin-top: 10px;margin-left: 85px">Không Hiển Thị
                            <input type="radio" <?php if ($data->hot == 0) {
                                echo 'checked';
                            } ?> value="0" name="hot">
                            <span class="checkmark"></span>
                        </label>
                    </th>
                </tr>
                <tr>
                    <th>Danh Sách Được Khảo Sát :</th>
                    <th style="max-width: 500px;">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th style="text-align: center"><u>Nhóm Được Khảo Sát</u></th>
                                <th style="text-align: center">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#Groups">
                                        Add
                                    </button>
                                </th>
                            </tr>
                            <?php foreach ($listGroup as $value) { ?>
                                <tr>
                                    <th><?= $value['Groups']['name'] ?></th>
                                    <th style="text-align: center">
                                        <button type="button" onclick="deleteGroup('<?= $value['Group_s']['id'] ?>')"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </th>
                                </tr>
                            <?php } ?>
                        </table>
                    </th>
                    <th>
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th style="text-align: center"><u>Thành Viên Được Khảo Sát</u></th>
                                <th style="text-align: center">
                                    <button type="button" data-toggle="modal"
                                            data-target="#Users" class="btn btn-success">Add
                                    </button>
                                </th>
                            </tr>
                            <?php foreach ($listUser as $value) { ?>
                                <tr>
                                    <th><?= $value['Users']['email'] ?></th>
                                    <th style="text-align: center">
                                        <button type="button" onclick="deleteUser('<?= $value['User_survey']['id'] ?>')"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </th>
                                </tr>
                            <?php } ?>
                        </table>
                    </th>
                </tr>
            </table>
            <fieldset class="col-lg-10 col-lg-offset-1">
                <legend>
                    Danh Sách Câu Hỏi
                    <a style="width: 100px" href="<?= URL ?>surveys/view/<?php echo $data->id ?>"
                       class="btn btn-warning">
                        <i class="far fa-eye"></i></i> View</a>
                </legend>
                <table class="table table-bordered table-hover">
                    <tr style="background-color: #333333;color: white">
                        <th>Type Ques</th>
                        <th>Question</th>
                        <th>Answers</th>
                        <th>Type Answ</th>
                        <th>Status</th>
                        <th style="width: 200px;">
                            <a style="width: 130px"
                               href="<?= URL ?>questions/add/<?php echo $data->id ?>"
                               class="btn btn-success">
                                <i class="fas fa-plus"></i> Thêm Câu Hỏi</a>
                        </th>
                    </tr>
                    <?php foreach ($data2 as $value) { ?>
                    <tr>
                        <td><?php echo $value->type_question ?></td>
                        <?php if ($value->type_question == 'Images') { ?>
                            <td class="rows<?= $value->id ?>"><img style="height: 100px;width: 200px;"
                                                                   src="<?= URL ?>img/<?= $value->name ?>"></td>
                        <?php } else { ?>
                            <td><?php echo $value->name ?></td>
                        <?php } ?>
                        <td><?php echo $value->answers ?></td>
                        <td><?php echo $value->type_answer ?></td>
                        <td><?php echo $value->status ?></td>
                        <td class="rows<?= $value->id ?>">
                            <a class="btn btn-primary" href="<?= URL ?>questions/edit/<?php echo $value->id ?>">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" id="<?= $value->id ?>" class="btn btn-danger click">
                                <i class="far fa-trash-alt"></i> Delete</a>
                            </button>
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
        <!--   Modal Nhóm    -->
        <form method="post" action="<?= URL ?>surveys/formgroup">
            <div id="Groups" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 style="font-weight: bold;color: black;text-align: center" class="modal-title">Danh Sách
                                Nhóm</h2>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover table-bordered">
                                <?php foreach ($dataGroup as $key => $value) { ?>
                                    <tr>
                                        <th><?= $key + 1 ?></th>
                                        <th><?= $value->name ?></th>
                                        <th>
                                        <span class="button-checkbox">
                                            <button type="button" class="btn" data-color="success"
                                                    style="width: 40px;"></button>
                                            <input type="checkbox" value="<?= $value->id ?>" class="hidden"
                                                   name="group[<?= $value->id ?>]"/>
                                        </span>
                                        </th>
                                        <th style="display: none">
                                            <input type="number" value="<?= $data->id ?>" name="id"/>
                                        </th>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-times"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--   End Modal Nhóm    -->

        <!-- Modal Thành Viên -->
        <form method="post" action="<?= URL ?>surveys/formuser">
            <div id="Users" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 style="font-weight: bold;color: black;text-align: center" class="modal-title">Danh Thành
                                Viên</h2>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover table-bordered">
                                <?php foreach ($dataUser as $key => $value) { ?>
                                    <tr>
                                        <th><?= $key + 1 ?></th>
                                        <th><?= $value->email ?></th>
                                        <th>
                                        <span class="button-checkbox">
                                            <button type="button" class="btn" data-color="success"
                                                    style="width: 40px;"></button>
                                            <input type="checkbox" value="<?= $value->id ?>" class="hidden"
                                                   name="user[<?= $value->id ?>]"/>
                                        </span>
                                        </th>
                                        <th style="display: none">
                                            <input type="number" value="<?= $data->id ?>" name="id"/>
                                        </th>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fas fa-times"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--   End Modal Thành Viên    -->
    </fieldset>
    <?php echo $this->Html->script('validate/Surveys/add_edit'); ?>
    <?php echo $this->Html->script('checkbox.js'); ?>
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            document.execCommand("copy");
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".click").click(function () {
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
                                url: '<?= URL ?>questions/clickDelete?id=' + id,
                                type: 'GET',
                                success: function (res) {
                                    if (res == 'ok') {
                                        swal(" Đã Xóa Thành Công !", {
                                            icon: "success",
                                        });
                                    }
                                }
                            });
                            $(".rows" + id).remove();
                        } else {
                            swal("Hủy Xóa Thành Công !");
                        }
                    });
            });
        });
    </script>
    <script>
        function deleteGroup(id) {
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
                            url: '<?= URL ?>surveys/deletegroup?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Xóa Thành Công !", {
                                        icon: "success",
                                    }).then(function () {
                                        location.reload();
                                    });
                                }
                            }
                        });
                    }
                });
        }

        function deleteUser(id) {
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
                            url: '<?= URL ?>surveys/deleteuser?id=' + id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Xóa Thành Công !", {
                                        icon: "success",
                                    }).then(function () {
                                        location.reload();
                                    });
                                }
                            }
                        });
                    }
                });
        }
    </script>

<?php } ?>