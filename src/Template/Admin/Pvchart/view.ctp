<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="pvlog view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>ptag</th>
        <td><?= h($pvlog->ptag) ?></td>
    </tr>
    
    <tr>
        <th>ip</th>
        <td><?= h($pvlog->ip) ?></td>
    </tr>
    
    <tr>
        <th>屏幕尺寸</th>
        <td><?= h($pvlog->screen) ?></td>
    </tr>
    
    <tr>
        <th>访问页</th>
        <td><?= h($pvlog->refer) ?></td>
    </tr>
    
    <tr>
        <th>act</th>
        <td><?= h($pvlog->act) ?></td>
    </tr>
    
    <tr>
        <th>用户头</th>
        <td><?= h($pvlog->useragent) ?></td>
    </tr>
    
    <tr>
        <th>create_time</th>
        <td><?= h($pvlog->create_time) ?></td>
    </tr>
</div>
</body>
