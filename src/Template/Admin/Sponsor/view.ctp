<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="sponsor view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户</th>
        <td><?= h($sponsor->user->truename) ?></td>
    </tr>
    
    <tr>
        <th>活动</th>
        <td><?= h($sponsor->activity->title) ?></td>
    </tr>
    
    <tr>
        <th>提交时间</th>
        <td><?= h($sponsor->create_time) ?></td>
    </tr>
    
    <tr>
        <th>类型</th>
        <td><?= h($sponsor->recommendTypes) ?></td>
    </tr>
    
    <tr>
        <th>描述</th>
        <td><?= h($sponsor->description) ?></td>
    </tr>
</div>
</body>
