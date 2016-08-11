<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
<div class="projrong view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
    
    <tr>
        <th>发布人id</th>
        <td><?= h($projrong->user_id) ?></td>
    </tr>
    
    <tr>
        <th>发布人</th>
        <td><?= h($projrong->publisher) ?></td>
    </tr>
    
    <tr>
        <th>公司</th>
        <td><?= h($projrong->company) ?></td>
    </tr>
    
    <tr>
        <th>项目名称</th>
        <td><?= h($projrong->title) ?></td>
    </tr>
    
    <tr>
        <th>融资阶段</th>
        <td><?= h($projrong->stage_id) ?></td>
    </tr>
    
    <tr>
        <th>地点</th>
        <td><?= h($projrong->address) ?></td>
    </tr>
    
    <tr>
        <th>融资规模</th>
        <td><?= h($projrong->scale_id) ?></td>
    </tr>
    
    <tr>
        <th>股份</th>
        <td><?= h($projrong->stock) ?></td>
    </tr>
    
    <tr>
        <th>阅读数</th>
        <td><?= h($projrong->read_nums) ?></td>
    </tr>
    
    <tr>
        <th>点赞数</th>
        <td><?= h($projrong->praise_nums) ?></td>
    </tr>
    
    <tr>
        <th>评论数</th>
        <td><?= h($projrong->comment_nums) ?></td>
    </tr>
    
    <tr>
        <th>封面</th>
        <td><?= h($projrong->cover) ?></td>
    </tr>
    
    <tr>
        <th>活动内容</th>
        <td><?= h($projrong->body) ?></td>
    </tr>
    
    <tr>
        <th>项目简介</th>
        <td><?= h($projrong->summary) ?></td>
    </tr>
    
    <tr>
        <th>公司简介</th>
        <td><?= h($projrong->comp_desc) ?></td>
    </tr>
    
    <tr>
        <th>核心团队</th>
        <td><?= h($projrong->team) ?></td>
    </tr>
    
    <tr>
        <th>资料地址</th>
        <td><?= h($projrong->attach) ?></td>
    </tr>
    
    <tr>
        <th>状态</th>
        <td><?= h($projrong->status) ?></td>
    </tr>
    
    <tr>
        <th>跟进人id</th>
        <td><?= h($projrong->follow_id) ?></td>
    </tr>
    
    <tr>
        <th>跟进人</th>
        <td><?= h($projrong->follower) ?></td>
    </tr>
    
    <tr>
        <th>进度描述</th>
        <td><?= h($projrong->stage_remark) ?></td>
    </tr>
    
    <tr>
        <th>创建时间</th>
        <td><?= h($projrong->create_time) ?></td>
    </tr>
    
    <tr>
        <th>更新时间</th>
        <td><?= h($projrong->update_time) ?></td>
    </tr>
</div>
</body>
