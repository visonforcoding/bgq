<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="bookChat view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户id</th>
        <td><?= h($bookChat->user_id) ?></td>
    </tr>
    
    <tr>
        <th>回复用户id</th>
        <td><?= h($bookChat->reply_id) ?></td>
    </tr>
    
    <tr>
        <th>约见id</th>
        <td><?= h($bookChat->book_id) ?></td>
    </tr>
    
    <tr>
        <th>内容</th>
        <td><?= h($bookChat->content) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($bookChat->create_time) ?></td>
    </tr>
</div>
</body>
