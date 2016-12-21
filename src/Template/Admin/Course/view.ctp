<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="course view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>培训标题</th>
        <td><?= h($course->title) ?></td>
    </tr>
    
    <tr>
        <th>内容介绍</th>
        <td><?= h($course->abstract) ?></td>
    </tr>
    
    <tr>
        <th>培训费用</th>
        <td><?= h($course->fee) ?></td>
    </tr>
    
    <tr>
        <th>优惠费用</th>
        <td><?= h($course->bonus_fee) ?></td>
    </tr>
    
    <tr>
        <th>优惠开始时间</th>
        <td><?= h($course->bonus_start_time) ?></td>
    </tr>
    
    <tr>
        <th>优惠结束时间</th>
        <td><?= h($course->bonus_end_time) ?></td>
    </tr>
    
    <tr>
        <th>是否上架</th>
        <td><?= h($course->is_online) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($course->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($course->update_time) ?></td>
    </tr>
</div>
</body>
