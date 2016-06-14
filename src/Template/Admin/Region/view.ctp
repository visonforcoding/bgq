<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Region'), ['action' => 'edit', $region->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Region'), ['action' => 'delete', $region->id], ['confirm' => __('Are you sure you want to delete # {0}?', $region->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Region'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Region'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="region view large-9 medium-8 columns content">
    <h3><?= h($region->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($region->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($region->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Activity') ?></h4>
        <?php if (!empty($region->activity)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Publisher') ?></th>
                <th><?= __('Industry Id') ?></th>
                <th><?= __('Company') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Time') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Scale') ?></th>
                <th><?= __('Read Nums') ?></th>
                <th><?= __('Praise Nums') ?></th>
                <th><?= __('Comment Nums') ?></th>
                <th><?= __('Cover') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('Summary') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th><?= __('Apply Nums') ?></th>
                <th><?= __('Apply Fee') ?></th>
                <th><?= __('Is Crowdfunding') ?></th>
                <th><?= __('Is Check') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($region->activity as $activity): ?>
            <tr>
                <td><?= h($activity->id) ?></td>
                <td><?= h($activity->admin_id) ?></td>
                <td><?= h($activity->user_id) ?></td>
                <td><?= h($activity->publisher) ?></td>
                <td><?= h($activity->industry_id) ?></td>
                <td><?= h($activity->company) ?></td>
                <td><?= h($activity->title) ?></td>
                <td><?= h($activity->time) ?></td>
                <td><?= h($activity->address) ?></td>
                <td><?= h($activity->scale) ?></td>
                <td><?= h($activity->read_nums) ?></td>
                <td><?= h($activity->praise_nums) ?></td>
                <td><?= h($activity->comment_nums) ?></td>
                <td><?= h($activity->cover) ?></td>
                <td><?= h($activity->body) ?></td>
                <td><?= h($activity->summary) ?></td>
                <td><?= h($activity->create_time) ?></td>
                <td><?= h($activity->update_time) ?></td>
                <td><?= h($activity->apply_nums) ?></td>
                <td><?= h($activity->apply_fee) ?></td>
                <td><?= h($activity->is_crowdfunding) ?></td>
                <td><?= h($activity->is_check) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activity', 'action' => 'view', $activity->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activity', 'action' => 'edit', $activity->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activity', 'action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
