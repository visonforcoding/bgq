<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="candidate view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>姓名</th>
        <td><?= h($candidate->truename) ?></td>
    </tr>
    
    <tr>
        <th>生日</th>
        <td><?= h($candidate->birthday) ?></td>
    </tr>
    
    <tr>
        <th>电话</th>
        <td><?= h($candidate->phone) ?></td>
    </tr>
    
    <tr>
        <th>邮箱</th>
        <td><?= h($candidate->email) ?></td>
    </tr>
    
    <tr>
        <th>地址</th>
        <td><?= h($candidate->address) ?></td>
    </tr>
    
    <tr>
        <th>工作经历</th>
        <td><?= h($candidate->career) ?></td>
    </tr>
    
    <tr>
        <th>教育经历</th>
        <td><?= h($candidate->education) ?></td>
    </tr>
    
    <tr>
        <th>期望薪水</th>
        <td><?= h($candidate->salary) ?></td>
    </tr>
    
    <tr>
        <th>其他说明</th>
        <td><?= h($candidate->remark) ?></td>
    </tr>
    
    <tr>
        <th>创建于</th>
        <td><?= h($candidate->create_time) ?></td>
    </tr>
    
    <tr>
        <th>修改于</th>
        <td><?= h($candidate->update_time) ?></td>
    </tr>
</div>
</body>
