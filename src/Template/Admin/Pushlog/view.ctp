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
            <?php foreach($user as $k=>$v): ?>
            <tr class="danger">
                <th>用户名</th>
                <td><?= h($v->truename) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
