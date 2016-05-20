<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activityapply'), ['action' => 'edit', $activityapply->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activityapply'), ['action' => 'delete', $activityapply->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityapply->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activityapply'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activityapply'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activityapply view large-9 medium-8 columns content">
    <h3><?= h($activityapply->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $activityapply->has('user') ? $this->Html->link($activityapply->user->truename, ['controller' => 'User', 'action' => 'view', $activityapply->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Activity') ?></th>
            <td><?= $activityapply->has('activity') ? $this->Html->link($activityapply->activity->title, ['controller' => 'Activity', 'action' => 'view', $activityapply->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($activityapply->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Pass') ?></th>
            <td><?= $this->Number->format($activityapply->is_pass) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Top') ?></th>
            <td><?= $this->Number->format($activityapply->is_top) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($activityapply->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($activityapply->update_time) ?></td>
        </tr>
    </table>
</div>
