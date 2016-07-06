<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Profiletag'), ['action' => 'edit', $profiletag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Profiletag'), ['action' => 'delete', $profiletag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profiletag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Profiletag'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profiletag'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="profiletag view large-9 medium-8 columns content">
    <h3><?= h($profiletag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($profiletag->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($profiletag->id) ?></td>
        </tr>
    </table>
</div>
