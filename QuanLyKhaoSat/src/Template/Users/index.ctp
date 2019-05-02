<fieldset class="col-md-12">
    <legend>Danh Sách Users</legend>
    <table class="table table-hover">
        <tr >
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
                    <a href="<?php URL ?>users/add"><button class="button">ADD</button></a>
                <?php } ?>
            </th>
        </tr>
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
                        <a
                            href="<?php URL ?>users/edit/<?php echo $value->id ?>"><button class="button">Edit</button></a>
                        <a
                           href="<?php URL ?>users/delete/<?php echo $value->id ?>"><button class="button">Delete</button></a>
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
