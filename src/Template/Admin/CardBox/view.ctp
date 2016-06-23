<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Card Box'), ['action' => 'edit', $cardBox->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Card Box'), ['action' => 'delete', $cardBox->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cardBox->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Card Box'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card Box'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Other Card'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Other Card'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cardBox view large-9 medium-8 columns content">
    <h3><?= h($cardBox->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('My Card Case') ?></th>
            <td><?= $cardBox->has('my_card_case') ? $this->Html->link($cardBox->my_card_case->truename, ['controller' => 'User', 'action' => 'view', $cardBox->my_card_case->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Other Card') ?></th>
            <td><?= $cardBox->has('other_card') ? $this->Html->link($cardBox->other_card->truename, ['controller' => 'User', 'action' => 'view', $cardBox->other_card->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cardBox->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Resend') ?></th>
            <td><?= $this->Number->format($cardBox->resend) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($cardBox->create_time) ?></td>
        </tr>
    </table>
</div>
