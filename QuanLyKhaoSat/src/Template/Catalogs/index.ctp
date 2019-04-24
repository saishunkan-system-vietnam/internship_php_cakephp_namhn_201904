<fieldset class="col-md-12" style="margin-top: 120px;border: 2px solid #222222">
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        Danh Sách Catalogs Surveys
    </legend>
    <table class="table" style="background-color: #222222;color: white;font-weight: bold;text-align: center">
        <tr style="height: 50px;line-height: 45px">
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Modified_at</th>
            <th>
                <a style="background-color: #222222;border: 2px solid white;color: white"
                   href="<?= SITE_URL ?>catalogs/add" class="btn">ADD</a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><a href="<?= SITE_URL ?>catalogs/listsurveys/<?php echo $value->id?>"><button style="height: 40px;border:2px solid white;background-color: #222222"><?php echo $value->name?></button></a></td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td>
                    <a style="background-color: #222222;border: 2px solid white;color: white"
                       href="<?= SITE_URL ?>catalogs/edit/<?php echo $value->id ?>" class="btn">Edit</a>
                    <a style="background-color: #222222;border: 2px solid white;color: white"
                       href="<?= SITE_URL ?>catalogs/delete/<?php echo $value->id ?>" class="btn">Delete</a>
                    <a style="background-color: #222222;border: 2px solid white;color: white"
                        href="<?= SITE_URL ?>catalogs/listsurveys/<?php echo $value->id?>" class="btn">List</a>
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
