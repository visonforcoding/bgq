<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="beauty view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户id</th>
        <td><?= h($beauty->user_id) ?></td>
    </tr>
    
    <tr>
        <th>票数</th>
        <td><?= h($beauty->vote_nums) ?></td>
    </tr>
    
    <tr>
        <th>星座</th>
        <td><?= h($beauty->constellation) ?></td>
    </tr>
    
    <tr>
        <th>个人简介</th>
        <td><?= h($beauty->brief) ?></td>
    </tr>
    
    <tr>
        <th>参赛宣言</th>
        <td><?= h($beauty->declaration) ?></td>
    </tr>
    
    <tr>
        <th>兴趣爱好</th>
        <td><?= h($beauty->hobby) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($beauty->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($beauty->update_time) ?></td>
    </tr>
    
    <tr>
        <th>是否审核通过：0：未审核；1：审核通过；2：审核未通过</th>
        <td><?= h($beauty->is_pass) ?></td>
    </tr>
</div>
</body>
