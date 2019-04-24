<fieldset class="col-md-6 col-md-offset-3" style="margin-top: 120px;border: 2px solid #222222">
    <legend style="text-align: center">Danh Mục <?php echo $data->name ?></legend>
    <table>
        <?php foreach ($survey as $value) { ?>
            <tr>
                <th>
                    <a href="<?= SITE_URL ?>">
                        <button style="height: 40px;background-color: #6D6E73;color: black"><?php echo isset($value->name) ? $value->name : '' ?></button>
                    </a>
                </th>
                <td>
                    <a href=""><button style="font-weight:bold;height: 40px;background-color: #6D6E73;color: black">Edit</button></a>
                    <a href=""><button style="font-weight: bold;height: 40px;background-color: #6D6E73;color: black">Delete</button></a>
                </td>
            </tr>
        <?php } ?>
    </table>
</fieldset>