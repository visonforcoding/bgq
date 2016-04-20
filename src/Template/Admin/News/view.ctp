<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit News'), ['action' => 'edit', $news->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete News'), ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?> </li>
        <li><?= $this->Html->link(__('List News'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="news view large-9 medium-8 columns content">
    <h3><?= h($news->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($news->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Cover') ?></th>
            <td><?= h($news->cover) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($news->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($news->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Admin Id') ?></th>
            <td><?= $this->Number->format($news->admin_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Read Nums') ?></th>
            <td><?= $this->Number->format($news->read_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Praise Nums') ?></th>
            <td><?= $this->Number->format($news->praise_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Comment Nums') ?></th>
            <td><?= $this->Number->format($news->comment_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($news->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($news->update_time) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($news->body)); ?>
    </div>
</div>
