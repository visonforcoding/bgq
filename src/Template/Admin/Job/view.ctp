<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="job view large-9 medium-8 columns content">
    <h3><?= h($job->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= h($job->company) ?></td>
        </tr>
        <tr>
            <th><?= __('Admin') ?></th>
            <td><?= $job->has('admin') ? $this->Html->link($job->admin->username, ['controller' => 'Admin', 'action' => 'view', $job->admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Contact') ?></th>
            <td><?= h($job->contact) ?></td>
        </tr>
        <tr>
            <th><?= __('Position') ?></th>
            <td><?= h($job->position) ?></td>
        </tr>
        <tr>
            <th><?= __('Salary') ?></th>
            <td><?= h($job->salary) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($job->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Summary') ?></th>
            <td><?= h($job->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($job->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Earnings') ?></th>
            <td><?= $this->Number->format($job->earnings) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($job->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($job->update_time) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Industry') ?></h4>
        <?php if (!empty($job->industry)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Pid') ?></th>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($job->industry as $industry): ?>
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
