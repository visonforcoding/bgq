<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="classLearn view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户id</th>
        <td><?= h($classLearn->uid) ?></td>
    </tr>
    
    <tr>
        <th>课程id</th>
        <td><?= h($classLearn->class) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($classLearn->create_time) ?></td>
    </tr>
</div>
</body>
