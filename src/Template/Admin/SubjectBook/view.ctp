<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="subjectBook view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>话题id</th>
        <td><?= h($subjectBook->subject_id) ?></td>
    </tr>
    
    <tr>
        <th>用户id</th>
        <td><?= h($subjectBook->user_id) ?></td>
    </tr>
    
    <tr>
        <th>专家id</th>
        <td><?= h($subjectBook->savant_id) ?></td>
    </tr>
    
    <tr>
        <th>需求简介</th>
        <td><?= h($subjectBook->summary) ?></td>
    </tr>
    
    <tr>
        <th>0,未确认1确认通过2不予通过3完成</th>
        <td><?= h($subjectBook->status) ?></td>
    </tr>
    
    <tr>
        <th>专家标记是否已经完成约见</th>
        <td><?= h($subjectBook->is_done) ?></td>
    </tr>
    
    <tr>
        <th>create_time</th>
        <td><?= h($subjectBook->create_time) ?></td>
    </tr>
    
    <tr>
        <th>update_time</th>
        <td><?= h($subjectBook->update_time) ?></td>
    </tr>
</div>
</body>
