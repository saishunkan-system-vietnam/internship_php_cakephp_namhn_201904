<?php if ($HgNam[1] == "Admin") { ?>
    <fieldset class="col-md-10 col-md-offset-1">
        <legend>
            Danh Sách Danh Mục Khảo Sát
        </legend>
        <table class="table table-hover table-bordered">
            <tr>
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
        <ul class="pagination">
            <?php
            echo $this->Paginator->prev('« Previous ');
            echo $this->Paginator->numbers();
            echo $this->Paginator->next(' Next »');
            ?>
        </ul>
    </fieldset>
<?php } ?>
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
                            url: '<?= URL ?>catalogs/clickDelete?id='+ id,
                            type: 'GET',
                            success: function (res) {
                                if (res == 'ok') {
                                    swal(" Đã Xóa Thành Công !", {
                                        icon: "success",
                                    }).then(function(){
                                        window.location.replace("<?= URL ?>catalogs");
                                    });
                                }
                            }
                        });
                        // $(".rows" + id).remove();
                    } else {
                        swal("Hủy Xóa Thành Công !");
                    }
                });
        });
    });
</script>
