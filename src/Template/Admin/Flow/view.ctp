<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="flow view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户</th>
        <td><?= h($flow->user_id) ?></td>
    </tr>
    
    <tr>
        <th>关联id</th>
        <td><?= h($flow->relate_id) ?></td>
    </tr>
    
    <tr>
        <th>交易类型</th>
        <td><?= h($flow->type) ?></td>
    </tr>
    
    <tr>
        <th>类型名称</th>
        <td><?= h($flow->type_msg) ?></td>
    </tr>
    
    <tr>
        <th>是否收入1:收入2:支出</th>
        <td><?= h($flow->income) ?></td>
    </tr>
    
    <tr>
        <th>交易金额</th>
        <td><?= h($flow->amount) ?></td>
    </tr>
    
    <tr>
        <th>交易前金额</th>
        <td><?= h($flow->pre_amount) ?></td>
    </tr>
    
    <tr>
        <th>交易后金额</th>
        <td><?= h($flow->after_amount) ?></td>
    </tr>
    
    <tr>
        <th>交易状态</th>
        <td><?= h($flow->status) ?></td>
    </tr>
    
    <tr>
        <th>备注</th>
        <td><?= h($flow->remark) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($flow->create_time) ?></td>
    </tr>
    
    <tr>
        <th>修改时间</th>
        <td><?= h($flow->update_time) ?></td>
    </tr>
</div>
</body>
