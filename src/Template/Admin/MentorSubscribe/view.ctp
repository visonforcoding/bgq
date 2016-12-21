<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="mentorSubscribe view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户id</th>
        <td><?= h($mentorSubscribe->uid) ?></td>
    </tr>
    
    <tr>
        <th>导师id</th>
        <td><?= h($mentorSubscribe->mentor_id) ?></td>
    </tr>
    
    <tr>
        <th>是否已取消订阅</th>
        <td><?= h($mentorSubscribe->is_del) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($mentorSubscribe->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($mentorSubscribe->update_time) ?></td>
    </tr>
</div>
</body>
