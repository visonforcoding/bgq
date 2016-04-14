<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Agency'), ['action' => 'edit', $agency->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Agency'), ['action' => 'delete', $agency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $agency->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Agency'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Agency'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="agency view large-9 medium-8 columns content">
    <h3><?= h($agency->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($agency->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($agency->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pid') ?></th>
            <td><?= $this->Number->format($agency->pid) ?></td>
        </tr>
    </table>
</div>
