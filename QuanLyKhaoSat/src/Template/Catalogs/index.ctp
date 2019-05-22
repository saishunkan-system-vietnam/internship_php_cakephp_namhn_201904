<?php if ($HgNam[1] == "Admin") { ?>
<fieldset class="col-md-8 col-md-offset-2">
    <legend>
        Danh Sách Catalogs Surveys
    </legend>
    <table class="table table-hover table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Modified_at</th>
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
                    <a onClick="return confirm('Bạn Thật Sự Muốn Xóa <?= $value->name ?>?')" href="<?= URL ?>catalogs/delete/<?php echo $value->id ?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i> Delete</a>
                    </a>
                    <a href="<?= URL ?>catalogs/listsurveys/<?php echo $value->id ?>" class="btn btn-warning">
                        <i class="far fa-eye"></i></i> View</a>
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
<?php }?>
