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
        <th>用户id</th>
        <td><?= h($sponsor->user_id) ?></td>
    </tr>
    
    <tr>
        <th>活动id</th>
        <td><?= h($sponsor->activity_id) ?></td>
    </tr>
    
    <tr>
        <th>提交时间</th>
        <td><?= h($sponsor->create_time) ?></td>
    </tr>
    
    <tr>
        <th>类型值：1：嘉宾推荐；2：场地赞助；3：现金赞助；4：物品赞助；5：其他</th>
        <td><?= h($sponsor->type) ?></td>
    </tr>
    
    <tr>
        <th>描述</th>
        <td><?= h($sponsor->description) ?></td>
    </tr>
    
    <tr>
        <th>姓名</th>
        <td><?= h($sponsor->name) ?></td>
    </tr>
    
    <tr>
        <th>公司/机构</th>
        <td><?= h($sponsor->company) ?></td>
    </tr>
    
    <tr>
        <th>部门</th>
        <td><?= h($sponsor->department) ?></td>
    </tr>
    
    <tr>
        <th>职务</th>
        <td><?= h($sponsor->position) ?></td>
    </tr>
    
    <tr>
        <th>地址</th>
        <td><?= h($sponsor->address) ?></td>
    </tr>
    
    <tr>
        <th>未处理</th>
        <td><?= h($sponsor->status) ?></td>
    </tr>
    
    <tr>
        <th>容纳人数</th>
        <td><?= h($sponsor->people) ?></td>
    </tr>
</div>
</body>
