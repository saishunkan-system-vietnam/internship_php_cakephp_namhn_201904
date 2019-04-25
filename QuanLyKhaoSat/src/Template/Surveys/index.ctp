<?php echo $this->Html->css('HNam'); ?>
<fieldset class="col-md-12">
    <legend>
        Danh Sách Khảo Sát
    </legend>
    <table class="table" style=";;font-weight: bold;text-align: center">
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
                <a href="<?= SITE_URL ?>surveys/add">
                    <button>ADD</button>
                </a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><?php echo $value->name ?></td>
                <td></td>
                <td><?php echo $value->start_time ?></td>
                <td><?php echo $value->end_time ?></td>
                <td>
                    <?php if ($value->login_status == 'yes') { ?>
                        <i class='fas fa-clipboard-check' style='font-size:28px;color:#000055'></i>
                    <?php } ?>
                </td>
                <td><?php echo $value->maximum ?></td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td>
                    <a href="<?= SITE_URL ?>surveys/edit/<?php echo $value->id?>">
                        <button>Edit
                        </button>
                    </a>
                    <a href="<?= SITE_URL ?>surveys/delete/<?php echo $value->id?>">
                        <button>Delete</button>
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
