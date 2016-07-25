<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Collect Log'), ['action' => 'edit', $collectLog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Collect Log'), ['action' => 'delete', $collectLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $collectLog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Collect Logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Collect Log'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="collectLogs view large-9 medium-8 columns content">
    <h3><?= h($collectLog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $collectLog->has('user') ? $this->Html->link($collectLog->user->truename, ['controller' => 'User', 'action' => 'view', $collectLog->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Activity') ?></th>
            <td><?= $collectLog->has('activity') ? $this->Html->link($collectLog->activity->title, ['controller' => 'Activity', 'action' => 'view', $collectLog->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Msg') ?></th>
            <td><?= h($collectLog->msg) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($collectLog->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($collectLog->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($collectLog->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($collectLog->update_time) ?></td>
        </tr>
    </table>
</div>
