<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
<div class="biggieAd view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr class="muted">
        <th>大咖id</th>
        <td><?= h($biggieAd->savant_id) ?></td>
    </tr>
    
    <tr class="success">
        <th>图片地址</th>
        <td><?= h($biggieAd->url) ?></td>
    </tr>
    
    <tr class="warning">
        <th>创建时间</th>
        <td><?= h($biggieAd->create_time) ?></td>
    </tr>
</div>
</body>
