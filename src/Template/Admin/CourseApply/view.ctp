<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="courseApply view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>报名用户</th>
        <td><?= h($courseApply->uid) ?></td>
    </tr>
    
    <tr>
        <th>培训id</th>
        <td><?= h($courseApply->course_id) ?></td>
    </tr>
    
    <tr>
        <th>评价星数</th>
        <td><?= h($courseApply->star) ?></td>
    </tr>
    
    <tr>
        <th>是否已付款</th>
        <td><?= h($courseApply->is_pay) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($courseApply->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($courseApply->update_time) ?></td>
    </tr>
</div>
</body>
