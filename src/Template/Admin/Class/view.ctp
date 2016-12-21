<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="class view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>导师id</th>
        <td><?= h($clas->mentor_id) ?></td>
    </tr>
    
    <tr>
        <th>培训id</th>
        <td><?= h($clas->course_id) ?></td>
    </tr>
    
    <tr>
        <th>课程标题</th>
        <td><?= h($clas->title) ?></td>
    </tr>
    
    <tr>
        <th>课程介绍</th>
        <td><?= h($clas->abstract) ?></td>
    </tr>
    
    <tr>
        <th>音频</th>
        <td><?= h($clas->audio) ?></td>
    </tr>
    
    <tr>
        <th>课程ppt/pdf路径</th>
        <td><?= h($clas->pdf) ?></td>
    </tr>
    
    <tr>
        <th>是否免费</th>
        <td><?= h($clas->is_free) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($clas->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($clas->update_time) ?></td>
    </tr>
</div>
</body>
