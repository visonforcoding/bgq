<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="urlmap view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>url</th>
        <td><?= h($urlmap->url) ?></td>
    </tr>
    
    <tr>
        <th>映射</th>
        <td><?= h($urlmap->map) ?></td>
    </tr>
    
    <tr>
        <th>描述</th>
        <td><?= h($urlmap->descb) ?></td>
    </tr>
</div>
</body>
