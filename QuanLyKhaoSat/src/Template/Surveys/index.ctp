<fieldset class="col-md-12 container-fluid">
    <legend>Danh Sách Khảo Sát</legend>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Catalog</th>
            <th>Start_time</th>
            <th>End_time</th>
            <th>Login_status</th>
            <th>Maximum</th>
            <th>Created_at</th>
            <th>Modified_at</th>
            <th style="text-align: center">
                <a href="<?= URL ?>surveys/add" class="btn btn-success">
                    <i class="fas fa-plus"></i> ADD
                </a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->catalog_id ?></td>
                <td><?php echo $value->start_time ?></td>
                <td><?php echo $value->end_time ?></td>
                <td style="text-align: center">
                    <?php if ($value->login_status == 'on') { ?>
                        <i class="glyphicon glyphicon-check" style="font-size: 25px;"></i>
                    <?php } else { ?>
                        <i class="glyphicon glyphicon-unchecked" style="font-size: 25px;"></i>
                    <?php }?>
                </td>
                <td><?php echo $value->maximum ?></td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td style="width: 270px;text-align: center">
                    <a href="<?= URL ?>surveys/edit/<?php echo $value->id ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Write
                    </a>
                    <a href="<?= URL ?>surveys/delete/<?php echo $value->id ?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i> Delete</a>
                    </a> <br>
                    <a style="margin-top: 10px;" href="<?= URL ?>surveys/view/<?php echo $value->id ?>" class="btn btn-warning">
                        <i class="far fa-eye"></i></i> Views</a>
                    </a>
                    <a style="margin-top: 10px;" href="<?= URL ?>surveys/statist/<?php echo $value->id ?>" class="btn btn-info">
                        <i class="fas fa-torah"></i> Statist</a>
                    </a>
                </td>
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
