<h1>Users</h1>
<table border>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Year Old</th>
        <th>Address</th>
        <th>Telephone</th>
        <th>Level</th>
        <th>Action</th>
    </tr>
    <tr>
        <?= $this->Html->link(__('New Users'), ['action' => 'add']) ?>
    </tr>
    <?php foreach ($data as $value): ?>
        <tr>
            <td>
                <?= $this->Html->link($value->id, ['action' => 'view', $value->slug]) ?>
            </td>
            <td>
                <?= $this->Html->link($value->email, ['action' => 'view', $value->slug]) ?>
            </td>
            <td>
                <?= $this->Html->link($value->name, ['action' => 'view', $value->slug]) ?>
            </td>
            <td>
                <?= $this->Html->link($value->yearold, ['action' => 'view', $value->slug]) ?>
            </td>
            <td>
                <?= $this->Html->link($value->address, ['action' => 'view', $value->slug]) ?>
            </td>
            <td>
                <?= $this->Html->link($value->telephone, ['action' => 'view', $value->slug]) ?>
            </td>
            <td>
                <?= $this->Html->link($value->level, ['action' => 'view', $value->slug]) ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $value->id]) ?> &nbsp
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $value->id], ['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
echo $this->Paginator->prev('« Previous ');
echo " | " . $this->Paginator->numbers() . " | ";
echo $this->Paginator->next(' Next »');
echo " Page " . $this->Paginator->counter();
?>