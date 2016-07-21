<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="admin view large-9 medium-8 columns content">
    <h3><?= h($admin->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($admin->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Truename') ?></th>
            <td><?= h($admin->truename) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($admin->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($admin->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Login Ip') ?></th>
            <td><?= h($admin->login_ip) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($admin->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Ctime') ?></th>
            <td><?= h($admin->ctime) ?></td>
        </tr>
        <tr>
            <th><?= __('Utime') ?></th>
            <td><?= h($admin->utime) ?></td>
        </tr>
        <tr>
            <th><?= __('Login Time') ?></th>
            <td><?= h($admin->login_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $admin->enabled ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
</body>
