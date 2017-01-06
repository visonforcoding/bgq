<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="smsmsg view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>手机号</th>
        <td><?= h($smsmsg->phone) ?></td>
    </tr>
    
    <tr>
        <th>验证码</th>
        <td><?= h($smsmsg->code) ?></td>
    </tr>
    
    <tr>
        <th>content</th>
        <td><?= h($smsmsg->content) ?></td>
    </tr>
    
    <tr>
        <th>create_time</th>
        <td><?= h($smsmsg->create_time) ?></td>
    </tr>
</div>
</body>
