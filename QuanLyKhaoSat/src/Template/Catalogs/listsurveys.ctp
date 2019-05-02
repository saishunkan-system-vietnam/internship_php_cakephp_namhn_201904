<fieldset class="col-md-8 col-md-offset-2">
    <legend>
        <?php echo $data->name ?></legend>
    <table>
        <tr>
            <th class="col-md-8" style="text-align: center">Danh Sách Khảo Sát</th>
            <th class="col-md-4" style="text-align: center">
                <a href="<?= URL ?>surveys/add/">
                    <button class="button">Add</button>
                </a>
            </th>
        </tr>
        <?php foreach ($survey as $value) { ?>
            <tr>
                <th class="col-md-8" style="text-align: center">
                    <p style="border-bottom: 2px solid #222222"><?php echo isset($value->name) ? $value->name : '' ?></p>
                </th>
                <td class="col-md-4" style="text-align: center">
                    <a href="<?= URL ?>surveys/edit/<?php echo $value->id?>">
                        <button class="button">Edit</button>
                    </a>
                    <a href="<?= URL ?>surveys/delete/<?php echo $value->id?>">
                        <button class="button">Delete</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</fieldset>