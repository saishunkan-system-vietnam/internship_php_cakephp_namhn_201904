<?php if (empty($data)) { ?>
    <a href="<?= URL ?>catalogs"><h1><u style="color: red;font-weight: bold">Đường Link Này Không Tồn Tại</u></h1></a>
<?php } else { ?>
    <fieldset class="col-md-6 col-md-offset-3">
        <?php if (isset($error->name)) { ?>
            <div class="alert alert-danger">
                Danh Mục Khảo Sát Đã Có Sẵn ^^! Nhớ Nha :P
            </div>
        <?php } ?>
        <legend>
            Edit catalogs
        </legend>
        <form action="<?= URL ?>catalogs/edit/<?php echo $data->id ?>" id="Catalogs" method="post">
            <table class="table">
                <tr>
                    <th class="col-md-4">Name</th>
                    <td><input value="<?php echo isset($name) ? $name : $data->name ?>"
                               type="text" name="name" class="form-control">
                    </td>
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
<?php } ?>
<?php echo $this->Html->script('validate/catalog'); ?>