<fieldset class="col-md-12" style="margin-top: 120px;border: 2px solid #222222">
    <legend style="text-align: center;background-color: #222222;color: white;border-radius: 7px;height: 50px;line-height: 50px;font-size: 20px;font-weight: bold">
        Thông tin Users
    </legend>
    <table border="2" class="table" style="background-color: #222222;color: white;font-weight: bold;text-align: center">
        <tr style="height: 50px;line-height: 45px">
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Birth</th>
            <th>Level</th>
            <th>
                <?php if ($HgNam[1] == "Admin") { ?>
                    <a class="btn add" href="<?php SITE_URL ?>users/add"
                       style="background-color: #222222;border: 2px solid white;color: white">ADD</a>
                <?php } ?>
            </th>
        </tr>
        <tr style="height: 50px;"></tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><?php echo $value->email ?></td>
                <td><?php echo $value->password ?></td>
                <td><?php echo $value->fullname ?></td>
                <td><?php echo $value->address ?></td>
                <td><?php echo $value->phone ?></td>
                <td><?php echo $value->birth ?></td>
                <td><?php echo $value->level ?></td>
                <td>
                    <?php if (($HgNam[1] == 'Admin' && $value->level == 'Member') || ($HgNam[1] == 'Admin' && $value->id == $HgNam[2]) || ($HgNam[1] == 'Member' && $value->id == $HgNam[2])) { ?>
                        <a style="background-color: #222222;border: 2px solid white;color: white" class="btn edit"
                           href="<?php SITE_URL ?>users/edit/<?php echo $value->id ?>">Edit</a>
                        <a style="background-color: #222222;border: 2px solid white;color: white" class="btn delete"
                           href="<?php SITE_URL ?>users/delete/<?php echo $value->id ?>">Delete</a>
                    <?php } ?>
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
