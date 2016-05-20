<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Like Log'), ['action' => 'edit', $likeLog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Like Log'), ['action' => 'delete', $likeLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $likeLog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Like Logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Like Log'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="likeLogs view large-9 medium-8 columns content">
    <h3><?= h($likeLog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Msg') ?></th>
            <td><?= h($likeLog->msg) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($likeLog->id) ?></td>
        </tr>
        <tr>
            <th><?= __('User Id') ?></th>
            <td><?= $this->Number->format($likeLog->user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Relate Id') ?></th>
            <td><?= $this->Number->format($likeLog->relate_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($likeLog->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($likeLog->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($likeLog->update_time) ?></td>
        </tr>
    </table>
</div>
