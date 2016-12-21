<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="rechargeGift view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>充值金额</th>
        <td><?= h($rechargeGift->recharge_money) ?></td>
    </tr>
    
    <tr>
        <th>充值赠送金额</th>
        <td><?= h($rechargeGift->gift) ?></td>
    </tr>
</div>
</body>
