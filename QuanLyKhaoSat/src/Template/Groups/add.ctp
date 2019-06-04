<fieldset class="col-md-6 col-md-offset-3">
    <?php if (isset($error->name)) { ?>
        <div class="alert alert-danger">
            Nhóm Users Đã Có Sẵn ^^! Nhớ Nha :P
        </div>
    <?php } ?>
    <legend>
        Thêm Nhóm Users
    </legend>
    <form action="<?= URL ?>groups/add" id="Groups" method="post">
        <table class="table table-hover">
            <tr>
                <th class="col-md-4">Nhập Tên Nhóm </th>
                <td><input value="<?php echo isset($result[0]) ? $result[0] : '' ?>"
                           type="text" name="name" class="form-control"></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button class="btn btn-primary" type="submit"><i class="far fa-thumbs-up"></i> Submit</button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-sync-alt"></i> Reset</button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?= $this->Html->script('validate/Groups/group'); ?>