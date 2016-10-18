<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="invoice view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>用户id</th>
        <td><?= h($invoice->user_id) ?></td>
    </tr>
    
    <tr>
        <th>是否是增值税发票</th>
        <td><?= h($invoice->is_VAT) ?></td>
    </tr>
    
    <tr>
        <th>公司名称</th>
        <td><?= h($invoice->company) ?></td>
    </tr>
    
    <tr>
        <th>总金额</th>
        <td><?= h($invoice->sum) ?></td>
    </tr>
    
    <tr>
        <th>收件人</th>
        <td><?= h($invoice->recipient) ?></td>
    </tr>
    
    <tr>
        <th>收件人电话</th>
        <td><?= h($invoice->recipient_phone) ?></td>
    </tr>
    
    <tr>
        <th>收件人地址</th>
        <td><?= h($invoice->recipient_address) ?></td>
    </tr>
    
    <tr>
        <th>纳税人识别号</th>
        <td><?= h($invoice->registration_num) ?></td>
    </tr>
    
    <tr>
        <th>公司地址</th>
        <td><?= h($invoice->company_address) ?></td>
    </tr>
    
    <tr>
        <th>公司电话</th>
        <td><?= h($invoice->company_phone) ?></td>
    </tr>
    
    <tr>
        <th>开户行</th>
        <td><?= h($invoice->bank) ?></td>
    </tr>
    
    <tr>
        <th>开户账号</th>
        <td><?= h($invoice->bank_account) ?></td>
    </tr>
    
    <tr>
        <th>是否发货</th>
        <td><?= h($invoice->is_shipment) ?></td>
    </tr>
    
    <tr>
        <th>快递</th>
        <td><?= h($invoice->shipment_express) ?></td>
    </tr>
    
    <tr>
        <th>快递单号</th>
        <td><?= h($invoice->shipment_number) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($invoice->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($invoice->update_time) ?></td>
    </tr>
</div>
</body>
