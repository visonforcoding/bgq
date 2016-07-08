<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Meet Subject'), ['action' => 'edit', $meetSubject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meet Subject'), ['action' => 'delete', $meetSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meetSubject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Meet Subject'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meet Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="meetSubject view large-9 medium-8 columns content">
    <h3><?= h($meetSubject->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $meetSubject->has('user') ? $this->Html->link($meetSubject->user->truename, ['controller' => 'User', 'action' => 'view', $meetSubject->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($meetSubject->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($meetSubject->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Invite Time') ?></th>
            <td><?= h($meetSubject->invite_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($meetSubject->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($meetSubject->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($meetSubject->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($meetSubject->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Time') ?></th>
            <td><?= $this->Number->format($meetSubject->last_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($meetSubject->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($meetSubject->update_time) ?></td>
        </tr>
    </table>
</div>
