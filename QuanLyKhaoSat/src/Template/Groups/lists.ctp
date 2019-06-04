<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<fieldset class="col-md-6 col-md-offset-3">
    <legend></legend>
    <table class="table table-striped table-bordered">
        <tr style="background-color: #333333;color: white">
            <th class="col-md-1">Thứ Tự</th>
            <th class="col-md-6" style="text-align: center;font-size: 20px;">Danh Sách Thành Viên</th>
            <th>
                <!-- Trigger the modal with a button -->
                <button style="width: 110px;" onclick="listMember('<?= $groups->id ?>')" type="button" class="btn btn-success"
                        data-toggle="modal" data-target="#myModal"><i
                            class="fas fa-plus"></i> ADD
                </button>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="color: black;font-weight: bold">Danh Sách Member</h4>
                            </div>
                            <form action="" method="post">
                            <div class="modal-body dataShow" style="color: black;font-weight: bold"></div>
                                <div class="modal-footer">
                                    <button style="width: 150px;height: 40px;" type="submit" class="btn"><i
                                                class="fas fa-plus"></i> Add Member</button>
                                    </button>
                                    <button style="width: 100px;height: 40px;"
                                            type="button" class="btn" data-dismiss="modal"><i class="fas fa-door-closed"></i> Close</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </th>
        </tr>
        <?php if (empty($data)) { ?>
            <tr>
                <th style="font-size: 25px;color: red;border-bottom: 2px solid red;" colspan="3">
                    Hiện Tại Nhóm Chưa Có Thành Viên
                </th>
            </tr>
        <?php } else { ?>
            <?php foreach ($data as $key => $value) { ?>
                <tr class="rows<?= $value['Details']['id'] ?>">
                    <th><?= $key + 1 ?></th>
                    <th class="col-md-8 rows<?= $value->id ?>" style="text-align: center">
                        <p><?php echo isset($value['Users']['email']) ? $value['Users']['email'] : '' ?></p>
                    </th>
                    <td class="col-md-4 rows<?= $value->id ?>">
                        <button style="width: 110px;" id="<?= $value['Details']['id'] ?>" type="button" class="btn btn-danger click">
                            <i class="far fa-trash-alt"></i> Delete</a>
                        </button>
                    </td>
                </tr>
            <?php }
        } ?>
    </table>
    <a href="<?= URL ?>groups">
        <button class="pull-right btn" style="width: 150px;height: 45px" type="button"><i class="fas fa-undo-alt"></i> Page Groups
        </button>
    </a>
</fieldset>
<script>
    function listMember(id) {
        $.ajax({
            url: '<?= URL ?>groups/listmember?id=' + id,
            type: 'GET',
            success: function (res) {
                $('.dataShow').html(res);
                console.log(res);
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click").click(function () {
            var id = $(this).attr("id");
            swal({
                title: "Bạn Có Chắc Muốn Xóa Thành Viên Này Không?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?= URL ?>groups/deletemember?id=' + id,
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
                    }
                });
        });
    });
</script>