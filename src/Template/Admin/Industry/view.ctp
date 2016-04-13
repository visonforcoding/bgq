<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Industry'), ['action' => 'edit', $industry->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Industry'), ['action' => 'delete', $industry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $industry->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Industry'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Industry'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="industry view large-9 medium-8 columns content">
    <h3><?= h($industry->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($industry->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($industry->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pid') ?></th>
            <td><?= $this->Number->format($industry->pid) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User') ?></h4>
        <?php if (!empty($industry->user)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Phone') ?></th>
                <th><?= __('Pwd') ?></th>
                <th><?= __('Truename') ?></th>
                <th><?= __('Level') ?></th>
                <th><?= __('Idcard') ?></th>
                <th><?= __('Company') ?></th>
                <th><?= __('Position') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Gender') ?></th>
                <th><?= __('Industry Id') ?></th>
                <th><?= __('Goodat') ?></th>
                <th><?= __('City Id') ?></th>
                <th><?= __('Card Path') ?></th>
                <th><?= __('Avatar') ?></th>
                <th><?= __('Ymjy') ?></th>
                <th><?= __('Ywnl') ?></th>
                <th><?= __('Reason') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($industry->user as $user): ?>
            <tr>
                <td><?= h($user->id) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?= h($user->pwd) ?></td>
                <td><?= h($user->truename) ?></td>
                <td><?= h($user->level) ?></td>
                <td><?= h($user->idcard) ?></td>
                <td><?= h($user->company) ?></td>
                <td><?= h($user->position) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->gender) ?></td>
                <td><?= h($user->industry_id) ?></td>
                <td><?= h($user->goodat) ?></td>
                <td><?= h($user->city_id) ?></td>
                <td><?= h($user->card_path) ?></td>
                <td><?= h($user->avatar) ?></td>
                <td><?= h($user->ymjy) ?></td>
                <td><?= h($user->ywnl) ?></td>
                <td><?= h($user->reason) ?></td>
                <td><?= h($user->status) ?></td>
                <td><?= h($user->create_time) ?></td>
                <td><?= h($user->update_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'User', 'action' => 'view', $user->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'User', 'action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
