<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Withdraw'), ['action' => 'edit', $withdraw->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Withdraw'), ['action' => 'delete', $withdraw->id], ['confirm' => __('Are you sure you want to delete # {0}?', $withdraw->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Withdraw'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Withdraw'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="withdraw view large-9 medium-8 columns content">
    <h3><?= h($withdraw->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $withdraw->has('user') ? $this->Html->link($withdraw->user->truename, ['controller' => 'User', 'action' => 'view', $withdraw->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Cardno') ?></th>
            <td><?= h($withdraw->cardno) ?></td>
        </tr>
        <tr>
            <th><?= __('Bank') ?></th>
            <td><?= h($withdraw->bank) ?></td>
        </tr>
        <tr>
            <th><?= __('Truename') ?></th>
            <td><?= h($withdraw->truename) ?></td>
        </tr>
        <tr>
            <th><?= __('Remark') ?></th>
            <td><?= h($withdraw->remark) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($withdraw->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Amount') ?></th>
            <td><?= $this->Number->format($withdraw->amount) ?></td>
        </tr>
        <tr>
            <th><?= __('Fee') ?></th>
            <td><?= $this->Number->format($withdraw->fee) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($withdraw->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($withdraw->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($withdraw->update_time) ?></td>
        </tr>
    </table>
</div>
