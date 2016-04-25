<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Adminmsg'), ['action' => 'edit', $adminmsg->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Adminmsg'), ['action' => 'delete', $adminmsg->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminmsg->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Adminmsg'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Adminmsg'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="adminmsg view large-9 medium-8 columns content">
    <h3><?= h($adminmsg->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Msg') ?></th>
            <td><?= h($adminmsg->msg) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($adminmsg->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($adminmsg->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($adminmsg->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($adminmsg->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($adminmsg->update_time) ?></td>
        </tr>
    </table>
</div>
