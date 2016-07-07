<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Savant'), ['action' => 'edit', $savant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Savant'), ['action' => 'delete', $savant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $savant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Savant'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Savant'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List News'), ['controller' => 'News', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News'), ['controller' => 'News', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="savant view large-9 medium-8 columns content">
    <h3><?= h($savant->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $savant->has('user') ? $this->Html->link($savant->user->truename, ['controller' => 'User', 'action' => 'view', $savant->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Cover') ?></th>
            <td><?= h($savant->cover) ?></td>
        </tr>
        <tr>
            <th><?= __('Xmjy') ?></th>
            <td><?= h($savant->xmjy) ?></td>
        </tr>
        <tr>
            <th><?= __('Zyys') ?></th>
            <td><?= h($savant->zyys) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($savant->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($savant->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Reco Nums') ?></th>
            <td><?= $this->Number->format($savant->reco_nums) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related News') ?></h4>
        <?php if (!empty($savant->news)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('Admin Name') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Read Nums') ?></th>
                <th><?= __('Praise Nums') ?></th>
                <th><?= __('Comment Nums') ?></th>
                <th><?= __('Cover') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('Summary') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Thumb') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($savant->news as $news): ?>
            <tr>
                <td><?= h($news->id) ?></td>
                <td><?= h($news->admin_id) ?></td>
                <td><?= h($news->admin_name) ?></td>
                <td><?= h($news->title) ?></td>
                <td><?= h($news->read_nums) ?></td>
                <td><?= h($news->praise_nums) ?></td>
                <td><?= h($news->comment_nums) ?></td>
                <td><?= h($news->cover) ?></td>
                <td><?= h($news->body) ?></td>
                <td><?= h($news->summary) ?></td>
                <td><?= h($news->create_time) ?></td>
                <td><?= h($news->update_time) ?></td>
                <td><?= h($news->user_id) ?></td>
                <td><?= h($news->thumb) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'News', 'action' => 'view', $news->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'News', 'action' => 'edit', $news->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'News', 'action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Activity') ?></h4>
        <?php if (!empty($savant->activity)): ?>
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
                <th><?= __('Is Top') ?></th>
                <th><?= __('Guest') ?></th>
                <th><?= __('Reason') ?></th>
                <th><?= __('Region Id') ?></th>
                <th><?= __('Qrcode') ?></th>
                <th><?= __('Thumb') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($savant->activity as $activity): ?>
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
                <td><?= h($activity->is_top) ?></td>
                <td><?= h($activity->guest) ?></td>
                <td><?= h($activity->reason) ?></td>
                <td><?= h($activity->region_id) ?></td>
                <td><?= h($activity->qrcode) ?></td>
                <td><?= h($activity->thumb) ?></td>
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
