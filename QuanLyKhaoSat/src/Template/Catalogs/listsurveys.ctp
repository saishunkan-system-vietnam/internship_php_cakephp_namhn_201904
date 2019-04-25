<?php echo $this->Html->css('HNam'); ?>
<fieldset class="col-md-6 col-md-offset-3">
    <legend>
        Danh Mục <?php echo $data->name ?></legend>
    <table>
        <?php foreach ($survey as $value) { ?>
            <tr>
                <th>
                    <button><?php echo isset($value->name) ? $value->name : '' ?></button>
                </th>
                <td>
                    <a href="">
                        <button>Edit</button>
                    </a>
                    <a href="">
                        <button>Delete</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</fieldset>