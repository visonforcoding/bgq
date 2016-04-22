<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Projrong'), ['action' => 'edit', $projrong->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Projrong'), ['action' => 'delete', $projrong->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projrong->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projrong'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projrong'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Industry', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Industry', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projrong view large-9 medium-8 columns content">
    <h3><?= h($projrong->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $projrong->has('user') ? $this->Html->link($projrong->user->truename, ['controller' => 'User', 'action' => 'view', $projrong->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Publisher') ?></th>
            <td><?= h($projrong->publisher) ?></td>
        </tr>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= h($projrong->company) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($projrong->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Rzjd') ?></th>
            <td><?= h($projrong->rzjd) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($projrong->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Scale') ?></th>
            <td><?= h($projrong->scale) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock') ?></th>
            <td><?= h($projrong->stock) ?></td>
        </tr>
        <tr>
            <th><?= __('Cover') ?></th>
            <td><?= h($projrong->cover) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($projrong->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Comp Desc') ?></th>
            <td><?= h($projrong->comp_desc) ?></td>
        </tr>
        <tr>
            <th><?= __('Team') ?></th>
            <td><?= h($projrong->team) ?></td>
        </tr>
        <tr>
            <th><?= __('Attach') ?></th>
            <td><?= h($projrong->attach) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($projrong->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Read Nums') ?></th>
            <td><?= $this->Number->format($projrong->read_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Praise Nums') ?></th>
            <td><?= $this->Number->format($projrong->praise_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Comment Nums') ?></th>
            <td><?= $this->Number->format($projrong->comment_nums) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($projrong->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($projrong->update_time) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($projrong->body)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Industry') ?></h4>
        <?php if (!empty($projrong->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Pid') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($projrong->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->pid) ?></td>
                <td><?= h($tags->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Industry', 'action' => 'view', $tags->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Industry', 'action' => 'edit', $tags->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Industry', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
