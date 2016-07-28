<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="admin view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr class="warning">
        <th>用户名</th>
        <td><?= h($admin->username) ?></td>
    </tr>
    
    <tr class="danger">
        <th>真实姓名</th>
        <td><?= h($admin->truename) ?></td>
    </tr>
    
    <tr class="success">
        <th>密码</th>
        <td><?= h($admin->password) ?></td>
    </tr>
    
    <tr class="success">
        <th>1启用0禁用</th>
        <td><?= h($admin->enabled) ?></td>
    </tr>
    
    <tr class="warning">
        <th>创建时间</th>
        <td><?= h($admin->ctime) ?></td>
    </tr>
    
    <tr class="active">
        <th>修改时间</th>
        <td><?= h($admin->utime) ?></td>
    </tr>
    
    <tr class="success">
        <th>登录时间</th>
        <td><?= h($admin->login_time) ?></td>
    </tr>
    
    <tr class="active">
        <th>登录ip</th>
        <td><?= h($admin->login_ip) ?></td>
    </tr>
</div>
</body>
