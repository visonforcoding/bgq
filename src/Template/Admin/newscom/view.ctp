<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activitycom'), ['action' => 'edit', $activitycom->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activitycom'), ['action' => 'delete', $activitycom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activitycom->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activitycom'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activitycom'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activitycom view large-9 medium-8 columns content">
    <h3><?= h($activitycom->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $activitycom->has('user') ? $this->Html->link($activitycom->user->truename, ['controller' => 'User', 'action' => 'view', $activitycom->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Replyuser') ?></th>
            <td><?= $activitycom->has('replyuser') ? $this->Html->link($activitycom->replyuser->truename, ['controller' => 'User', 'action' => 'view', $activitycom->replyuser->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Activity') ?></th>
            <td><?= $activitycom->has('activity') ? $this->Html->link($activitycom->activity->title, ['controller' => 'Activity', 'action' => 'view', $activitycom->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Body') ?></th>
            <td><?= h($activitycom->body) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($activitycom->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pid') ?></th>
            <td><?= $this->Number->format($activitycom->pid) ?></td>
        </tr>
        <tr>
            <th><?= __('Praise Nums') ?></th>
            <td><?= $this->Number->format($activitycom->praise_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($activitycom->create_time) ?></td>
        </tr>
    </table>
</div>
