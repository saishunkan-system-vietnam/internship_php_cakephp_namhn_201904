<fieldset class="col-md-12" style="margin-top: 120px;border: 2px solid #222222">
    <legend style="text-align: center;font-weight: bold">
        Danh Sách Khảo Sát
    </legend>
    <table class="table" style="background-color: #222222;color: white;font-weight: bold;text-align: center">
        <tr style="height: 50px;line-height: 45px">
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
                <a href="<?= SITE_URL?>surveys/add">
                    <button style="background-color: #222222;border: 2px solid white;border-radius: 5px;height: 35px;">
                        ADD
                    </button>
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
                <td style="text-align: center">
                    <?php if ($value->login_status == 'yes') { ?>
                        <i class='fas fa-clipboard-check' style='font-size:28px;color:white'></i>
                    <?php } ?>
                </td>
                <td><?php echo $value->maximum ?></td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td>
                    <a href="">
                        <button style="background-color: #222222;border: 2px solid white;border-radius: 5px;height: 35px;">
                            Edit
                        </button>
                    </a>
                    <a href="">
                        <button style="background-color: #222222;border: 2px solid white;border-radius: 5px;height: 35px;">
                            Delete
                        </button>
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
