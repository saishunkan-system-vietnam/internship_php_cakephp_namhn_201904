<?php echo $this->Html->css('haizzz'); ?>
<fieldset class="col-md-6 col-md-offset-3">
    <legend>
        Danh Mục <?php echo $data->name ?></legend>
    <table>
        <?php foreach ($survey as $value) { ?>
            <tr>
                <th>
                    <?php echo isset($value->name) ? $value->name : '' ?>
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