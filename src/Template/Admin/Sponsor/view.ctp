<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sponsor'), ['action' => 'edit', $sponsor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sponsor'), ['action' => 'delete', $sponsor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sponsor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sponsor'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sponsor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sponsor view large-9 medium-8 columns content">
    <h3><?= h($sponsor->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $sponsor->has('user') ? $this->Html->link($sponsor->user->truename, ['controller' => 'User', 'action' => 'view', $sponsor->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Activity') ?></th>
            <td><?= $sponsor->has('activity') ? $this->Html->link($sponsor->activity->title, ['controller' => 'Activity', 'action' => 'view', $sponsor->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($sponsor->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($sponsor->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= h($sponsor->company) ?></td>
        </tr>
        <tr>
            <th><?= __('Department') ?></th>
            <td><?= h($sponsor->department) ?></td>
        </tr>
        <tr>
            <th><?= __('Position') ?></th>
            <td><?= h($sponsor->position) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($sponsor->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($sponsor->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($sponsor->type) ?></td>
        </tr>
        <tr>
            <th><?= __('People') ?></th>
            <td><?= $this->Number->format($sponsor->people) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($sponsor->create_time) ?></td>
        </tr>
    </table>
</div>
