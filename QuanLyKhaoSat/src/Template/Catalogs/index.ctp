<?php echo $this->Html->css('haizzz'); ?>
<fieldset class="col-md-12">
    <legend>
        Danh Sách Catalogs Surveys
    </legend>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Modified_at</th>
            <th>
                <a href="<?= SITE_URL ?>catalogs/add">
                    <button>ADD</button>
                </a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <th><?php echo $value->id ?></th>
                <th><a href="<?= SITE_URL ?>catalogs/listsurveys/<?php echo $value->id ?>"><?php echo $value->name ?>
                    </a></th>
                <th><?php echo $value->created ?></th>
                <th><?php echo $value->modified ?></th>
                <th>
                    <a href="<?= SITE_URL ?>catalogs/edit/<?php echo $value->id ?>">
                        <button>Edit</button>
                    </a>
                    <a href="<?= SITE_URL ?>catalogs/delete/<?php echo $value->id ?>">
                        <button>Delete</button>
                    </a>
                    <a href="<?= SITE_URL ?>catalogs/listsurveys/<?php echo $value->id ?>">
                        <button>List</button>
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

