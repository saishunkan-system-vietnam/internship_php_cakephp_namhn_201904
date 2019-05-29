<fieldset class="container-fluid">
    <legend>Danh Sách Questions</legend>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name Questions</th>
            <th>Surveys</th>
            <th>Type Answer</th>
            <th>Answers</th>
            <th>Created</th>
            <th>Modified</th>
            <th>
                <a href="<?php URL ?>questions/add">
                    <button class="button">ADD</button>
                </a>
            </th>
        </tr>
        <?php foreach ($data as $value) { ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->survey_id ?></td>
                <td><?php echo $value->type_answer ?></td>
                <td><?php echo $value->answers ?></td>
                <td><?php echo $value->created ?></td>
                <td><?php echo $value->modified ?></td>
                <td><a href="<?php URL ?>questions/edit/<?php echo $value->id ?>">
                        <button class="button">Edit</button>
                    </a>
                    <a href="<?php URL ?>questions/delete/<?php echo $value->id ?>">
                        <button class="button">Delete</button>
                    </a><br>
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
