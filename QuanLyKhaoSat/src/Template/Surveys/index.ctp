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
            <th>
                <a href="<?= URL ?>surveys/add">
                    <button class="button">ADD</button>
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
                        <i class='fas fa-check-double' style='font-size:25px;color:#222222'></i>
                    <?php } ?>
                </td>
                <td><?php echo $value->maximum ?></td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td style="width: 270px;text-align: center">
                    <a href="<?= URL ?>surveys/edit/<?php echo $value->id ?>">
                        <button class="button">Edit</button>
                    </a>
                    <a href="<?= URL ?>surveys/delete/<?php echo $value->id ?>">
                        <button class="button">Delete</button>
                    </a>
                    <a href="<?= URL ?>surveys/listq/<?php echo $value->id ?>">
                        <button class="button">Views</button>
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
