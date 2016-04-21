<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activity'), ['action' => 'edit', $activity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activity'), ['action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activity view large-9 medium-8 columns content">
    <h3><?= h($activity->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= h($activity->company) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($activity->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Time') ?></th>
            <td><?= h($activity->time) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($activity->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Scale') ?></th>
            <td><?= h($activity->scale) ?></td>
        </tr>
        <tr>
            <th><?= __('Cover') ?></th>
            <td><?= h($activity->cover) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($activity->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($activity->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Admin Id') ?></th>
            <td><?= $this->Number->format($activity->admin_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Industry Id') ?></th>
            <td><?= $this->Number->format($activity->industry_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Read Nums') ?></th>
            <td><?= $this->Number->format($activity->read_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Praise Nums') ?></th>
            <td><?= $this->Number->format($activity->praise_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Comment Nums') ?></th>
            <td><?= $this->Number->format($activity->comment_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($activity->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($activity->update_time) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($activity->body)); ?>
    </div>
</div>
