<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:30%;
        }
    </style>
</head>
<body>
    <div class="meetSubject view large-9 medium-8 columns content">
        <table class="vertical-table table table-hover table-bordered">
            <tr class="danger">
                <th>订单号</th>
                <td>活动名称</td>
                <td>报名费用</td>
            </tr>
            <?php foreach($order as $k=>$v): ?>
            <tr class="danger">
                <th><?= h($v->lmorder->order_no) ?></th>
                <td><?= h($v->lmorder->activityapply->activity->title) ?></td>
                <td><?= h($v->lmorder->fee) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
