<fieldset class="col-md-6 col-md-offset-3">
    <legend>
        <?php echo $data->name ?></legend>
    <table class="table table-hover table-bordered">
        <tr>
            <th class="col-md-8" ="text-align: center">Danh Sách Khảo Sát</th>
            <th class="col-md-4" ="text-align: center">
                <a href="<?= URL ?>surveys/add/" class="btn btn-success">
                    <i class="fas fa-plus"></i> ADD
                </a>
            </th>
        </tr>
        <?php foreach ($survey as $value) { ?>
            <tr>
                <th class="col-md-8" ="text-align: center">
                    <p><?php echo isset($value->name) ? $value->name : '' ?></p>
                </th>
                <td class="col-md-4">
                    <a href="<?= URL ?>surveys/edit/<?php echo $value->id?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Write
                    </a>
                    <a onClick="return confirm('Bạn Thật Sự Muốn Xóa <?= $value->name ?>?')" href="<?= URL ?>surveys/delete/<?php echo $value->id?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i> Delete</a>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</fieldset>