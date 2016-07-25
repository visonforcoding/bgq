<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="activitycom view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr class="warning">
        <th>用户id</th>
        <td><?= h($activitycom->user_id) ?></td>
    </tr>
    
    <tr class="danger">
        <th>活动id</th>
        <td><?= h($activitycom->activity_id) ?></td>
    </tr>
    
    <tr class="active">
        <th>评论内容</th>
        <td><?= h($activitycom->body) ?></td>
    </tr>
    
    <tr class="active">
        <th>点赞数</th>
        <td><?= h($activitycom->praise_nums) ?></td>
    </tr>
    
    <tr class="active">
        <th>评论时间</th>
        <td><?= h($activitycom->create_time) ?></td>
    </tr>
    
    <tr class="success">
        <th>å›žå¤ç”¨æˆ·id</th>
        <td><?= h($activitycom->reply_id) ?></td>
    </tr>
    
    <tr class="success">
        <th>¸¸id</th>
        <td><?= h($activitycom->pid) ?></td>
    </tr>
</div>
</body>
