<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="mentor view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>导师姓名</th>
        <td><?= h($mentor->name) ?></td>
    </tr>
    
    <tr>
        <th>导师公司</th>
        <td><?= h($mentor->company) ?></td>
    </tr>
    
    <tr>
        <th>导师职位</th>
        <td><?= h($mentor->position) ?></td>
    </tr>
    
    <tr>
        <th>导师介绍</th>
        <td><?= h($mentor->introduce) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($mentor->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($mentor->update_time) ?></td>
    </tr>
</div>
</body>
