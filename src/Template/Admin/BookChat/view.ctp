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
        <th>用户</th>
        <td><?= $bookChat->user->truename ?>-<?=$bookChat->user->company?>-<?=$bookChat->user->position?></td>
    </tr>
    <tr>
        <th>对象</th>
        <td><?= $bookChat->reply_user->truename ?>-<?=$bookChat->reply_user->company?>-<?=$bookChat->reply_user->position?></td>
    </tr>
    <tr>
        <th>话题</th>
        <td><?= h($bookChat->subject_book->subject->title) ?></td>
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
