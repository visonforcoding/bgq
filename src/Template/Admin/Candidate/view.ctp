<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="candidate view large-9 medium-8 columns content">
    <h3><?= h($candidate->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Truename') ?></th>
            <td><?= h($candidate->truename) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($candidate->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($candidate->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($candidate->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Salary') ?></th>
            <td><?= h($candidate->salary) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($candidate->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Job Id') ?></th>
            <td><?= $this->Number->format($candidate->job_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Birthday') ?></th>
            <td><?= h($candidate->birthday) ?></td>
        </tr>
        <tr>
            <th><?= __('Create Time') ?></th>
            <td><?= h($candidate->create_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Update Time') ?></th>
            <td><?= h($candidate->update_time) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4>期望薪水</h4>
        <?= $this->Text->autoParagraph(h($candidate->career)); ?>
    </div>
    <div class="row">
        <h4>期望薪水</h4>
        <?= $this->Text->autoParagraph(h($candidate->education)); ?>
    </div>
</div>
</body>
