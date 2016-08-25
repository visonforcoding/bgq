<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="ptag view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>ptag</th>
        <td><?= h($ptag->ptag) ?></td>
    </tr>
    
    <tr>
        <th>描述</th>
        <td><?= h($ptag->desc) ?></td>
    </tr>
    
    <tr>
        <th>create_time</th>
        <td><?= h($ptag->create_time) ?></td>
    </tr>
    
    <tr>
        <th>update_time</th>
        <td><?= h($ptag->update_time) ?></td>
    </tr>
</div>
</body>
