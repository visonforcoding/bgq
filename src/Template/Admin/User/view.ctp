<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Industries'), ['controller' => 'Industry', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Industry'), ['controller' => 'Industry', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Pwd') ?></th>
            <td><?= h($user->pwd) ?></td>
        </tr>
        <tr>
            <th><?= __('Truename') ?></th>
            <td><?= h($user->truename) ?></td>
        </tr>
        <tr>
            <th><?= __('Level') ?></th>
            <td><?= h($user->level) ?></td>
        </tr>
        <tr>
            <th><?= __('Idcard') ?></th>
            <td><?= h($user->idcard) ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= h($user->company) ?></td>
        </tr>
        <tr>
            <th><?= __('Position') ?></th>
            <td><?= h($user->position) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Industry') ?></th>
            <td><?= $user->has('industry') ? $this->Html->link($user->industry->name, ['controller' => 'Industry', 'action' => 'view', $user->industry->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Goodat') ?></th>
            <td><?= h($user->goodat) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <tr>
            <th><?= __('Card Path') ?></th>
            <td><?= h($user->card_path) ?></td>
        </tr>
        <tr>
            <th><?= __('Avatar') ?></th>
            <td><?= h($user->avatar) ?></td>
        </tr>
        <tr>
            <th><?= __('Ymjy') ?></th>
            <td><?= h($user->ymjy) ?></td>
        </tr>
        <tr>
            <th><?= __('Ywnl') ?></th>
            <td><?= h($user->ywnl) ?></td>
        </tr>
        <tr>
            <th><?= __('Reason') ?></th>
            <td><?= h($user->reason) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Gender') ?></th>
            <td><?= $this->Number->format($user->gender) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($user->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($user->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($user->update_time) ?></td>
        </tr>
    </table>
</div>
