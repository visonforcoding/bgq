<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="job view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
        <tr>
            <th><?= __('公司') ?></th>
            <td><?= h($job->company) ?></td>
        </tr>
        <tr>
            <th><?= __('添加人') ?></th>
            <td><?= $job->has('admin') ? $this->Html->link($job->admin->username, ['controller' => 'Admin', 'action' => 'view', $job->admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('联系方式') ?></th>
            <td><?= h($job->contact) ?></td>
        </tr>
        <tr>
            <th><?= __('职位') ?></th>
            <td><?= h($job->position) ?></td>
        </tr>
        <tr>
            <th><?= __('薪资范围') ?></th>
            <td><?= h($job->salary) ?></td>
        </tr>
        <tr>
            <th><?= __('公司地址') ?></th>
            <td><?= h($job->address) ?></td>
        </tr>
        <tr>
            <th><?= __('职位简介') ?></th>
            <td><?= h($job->summary) ?></td>
        </tr>
        <tr>
            <th><?= __('分成方式') ?></th>
            <td><?= $this->Number->format($job->earnings) ?></td>
        </tr>
        <tr>
            <th><?= __('添加时间') ?></th>
            <td><?= h($job->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('更新时间') ?></th>
            <td><?= h($job->update_time) ?></td>
        </tr>
    </table>
</div>
</body>
