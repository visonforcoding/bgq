<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Biggie Ad'), ['action' => 'edit', $biggieAd->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Biggie Ad'), ['action' => 'delete', $biggieAd->id], ['confirm' => __('Are you sure you want to delete # {0}?', $biggieAd->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Biggie Ad'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biggie Ad'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="biggieAd view large-9 medium-8 columns content">
    <h3><?= h($biggieAd->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($biggieAd->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($biggieAd->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Savant Id') ?></th>
            <td><?= $this->Number->format($biggieAd->savant_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($biggieAd->create_time) ?></td>
        </tr>
    </table>
</div>
