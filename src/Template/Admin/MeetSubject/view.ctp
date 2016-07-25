<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="meetSubject view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr class="danger">
        <th>专家id</th>
        <td><?= h($meetSubject->user_id) ?></td>
    </tr>
    
    <tr class="active">
        <th>标题</th>
        <td><?= h($meetSubject->title) ?></td>
    </tr>
    
    <tr class="warning">
        <th>简介</th>
        <td><?= h($meetSubject->summary) ?></td>
    </tr>
    
    <tr class="warning">
        <th>约见类型</th>
        <td><?= h($meetSubject->type) ?></td>
    </tr>
    
    <tr class="muted">
        <th>持续时间</th>
        <td><?= h($meetSubject->invite_time) ?></td>
    </tr>
    
    <tr class="success">
        <th>价格</th>
        <td><?= h($meetSubject->price) ?></td>
    </tr>
    
    <tr class="warning">
        <th>约见地址</th>
        <td><?= h($meetSubject->address) ?></td>
    </tr>
    
    <tr class="danger">
        <th>持续时间</th>
        <td><?= h($meetSubject->last_time) ?></td>
    </tr>
    
    <tr class="warning">
        <th>创建于</th>
        <td><?= h($meetSubject->create_time) ?></td>
    </tr>
    
    <tr class="muted">
        <th>最后修改于</th>
        <td><?= h($meetSubject->update_time) ?></td>
    </tr>
</div>
</body>
