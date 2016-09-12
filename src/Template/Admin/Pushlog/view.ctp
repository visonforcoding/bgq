<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="pushlog view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>推送用户id</th>
        <td><?= h($pushlog->push_id) ?></td>
    </tr>
    
    <tr>
        <th>接收推送id</th>
        <td><?= h($pushlog->receive_id) ?></td>
    </tr>
    
    <tr>
        <th>推送标题</th>
        <td><?= h($pushlog->title) ?></td>
    </tr>
    
    <tr>
        <th>推送内容</th>
        <td><?= h($pushlog->body) ?></td>
    </tr>
    
    <tr>
        <th>推送类型：1：广播；2：单播；3：群播</th>
        <td><?= h($pushlog->type) ?></td>
    </tr>
    
    <tr>
        <th>是否成功</th>
        <td><?= h($pushlog->is_success) ?></td>
    </tr>
    
    <tr>
        <th>备注</th>
        <td><?= h($pushlog->remark) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($pushlog->create_time) ?></td>
    </tr>
</div>
</body>
