<fieldset class="col-md-10 col-md-offset-1">
    <legend>
        Danh Sách Catalogs Surveys
    </legend>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Modified_at</th>
            <th style="text-align: center">
                <a href="<?= URL ?>catalogs/add">
                    <button class="button">ADD</button>
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
                    <a href="<?= URL ?>catalogs/edit/<?php echo $value->id ?>">
                        <button class="button">Edit</button>
                    </a>
                    <a href="<?= URL ?>catalogs/delete/<?php echo $value->id ?>">
                        <button class="button">Delete</button>
                    </a>
                    <a href="<?= URL ?>catalogs/listsurveys/<?php echo $value->id ?>">
                        <button class="button">List</button>
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

