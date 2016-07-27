<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="withdraw view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr class="warning">
        <th>对象id</th>
        <td><?= h($withdraw->user_id) ?></td>
    </tr>
    
    <tr class="success">
        <th>提现金额</th>
        <td><?= h($withdraw->amount) ?></td>
    </tr>
    
    <tr class="muted">
        <th>银行卡号</th>
        <td><?= h($withdraw->cardno) ?></td>
    </tr>
    
    <tr class="warning">
        <th>银行</th>
        <td><?= h($withdraw->bank) ?></td>
    </tr>
    
    <tr class="active">
        <th>持卡人姓名</th>
        <td><?= h($withdraw->truename) ?></td>
    </tr>
    
    <tr class="active">
        <th>手续费</th>
        <td><?= h($withdraw->fee) ?></td>
    </tr>
    
    <tr class="danger">
        <th>备注</th>
        <td><?= h($withdraw->remark) ?></td>
    </tr>
    
    <tr class="success">
        <th>操作者id</th>
        <td><?= h($withdraw->admin_id) ?></td>
    </tr>
    
    <tr class="active">
        <th>状态,0未审核，1审核通过2,审核不通过</th>
        <td><?= h($withdraw->status) ?></td>
    </tr>
    
    <tr class="active">
        <th>create_time</th>
        <td><?= h($withdraw->create_time) ?></td>
    </tr>
    
    <tr class="warning">
        <th>update_time</th>
        <td><?= h($withdraw->update_time) ?></td>
    </tr>
</div>
</body>
