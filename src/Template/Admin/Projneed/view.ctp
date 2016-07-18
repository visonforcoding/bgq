<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="projneed view large-9 medium-8 columns content">
    <h3><?= h($projneed->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($projneed->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Needer') ?></th>
            <td><?= h($projneed->needer) ?></td>
        </tr>
        <tr>
            <th><?= __('Follower') ?></th>
            <td><?= h($projneed->follower) ?></td>
        </tr>
        <tr>
            <th><?= __('Stage Remark') ?></th>
            <td><?= h($projneed->stage_remark) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($projneed->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($projneed->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($projneed->update_time) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4>进度描述</h4>
        <?= $this->Text->autoParagraph(h($projneed->body)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Industry') ?></h4>
        <?php if (!empty($projneed->industry)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Pid') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($projneed->industry as $industry): ?>
            <tr>
                <td><?= h($industry->id) ?></td>
                <td><?= h($industry->pid) ?></td>
                <td><?= h($industry->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Industry', 'action' => 'view', $industry->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Industry', 'action' => 'edit', $industry->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Industry', 'action' => 'delete', $industry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $industry->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
</body>
