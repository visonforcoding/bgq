<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="projneed view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>标题</th>
        <td><?= h($projneed->title) ?></td>
    </tr>
    
    <tr>
        <th>内容</th>
        <td><?= h($projneed->body) ?></td>
    </tr>
    
    <tr>
        <th>需求方</th>
        <td><?= h($projneed->needer) ?></td>
    </tr>
    
    <tr>
        <th>联系方式</th>
        <td><?= h($projneed->contact) ?></td>
    </tr>
    
    <tr>
        <th>跟进人</th>
        <td><?= h($projneed->follower) ?></td>
    </tr>
    
    <tr>
        <th>进度描述</th>
        <td><?= h($projneed->stage_remark) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($projneed->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($projneed->update_time) ?></td>
    </tr>
</div>
</body>
