<fieldset class="col-md-8 col-md-offset-2">
    <legend>
        <?php echo $data->name ?></legend>
    <table class="table table-hover table-bordered">
        <tr>
            <th>Ảnh</th>
            <th class="col-md-8" ="text-align: center">Danh Sách Khảo Sát</th>
            <th class="col-md-4" ="text-align: center">
                <a href="<?= URL ?>surveys/add/<?= $data->id ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> ADD
                </a>
            </th>
        </tr>
        <?php foreach ($survey as $value) { ?>
            <tr>
                <th class="rows<?= $value->id ?>">
                    <img style="width: 150px;height: 120px;" src="<?= URL ?>img/survey/<?= $value->img_survey ?>" alt="">
                </th>
                <th  class="col-md-8 rows<?= $value->id ?>" style="text-align: center">
                    <p><?php echo isset($value->name) ? $value->name : '' ?></p>
                </th>
                <td class="col-md-4 rows<?= $value->id ?>">
                    <a href="<?= URL ?>surveys/edit/<?php echo $value->id?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Write
                    </a>
                    <button id="<?= $value->id ?>" type="button" class="btn btn-danger click">
                        <i class="far fa-trash-alt"></i> Delete</a>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
</fieldset>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click").click(function () {
            var id = $(this).attr("id");
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
                            url: '<?= URL ?>surveys/clickDelete?id='+ id,
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