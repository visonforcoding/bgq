<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;
        }
    </style>
</head>
<body>
    <div class="activityneed view large-9 medium-8 columns content">
        <table class="vertical-table table table-hover table-bordered">

            <tr>
                <th>姓名</th>
                <td><?= h($activityneed->truename) ?></td>
            </tr>

            <tr>
                <th>公司</th>
                <td><?= h($activityneed->company) ?></td>
            </tr>

            <tr>
                <th>职位</th>
                <td><?= h($activityneed->position) ?></td>
            </tr>

            <tr>
                <th>活动</th>
                <td><?= h($activityneed->title) ?></td>
            </tr>

            <tr>
                <th>内容</th>
                <td><?= h($activityneed->body) ?></td>
            </tr>

            <tr>
                <th>创建时间</th>
                <td><?= h($activityneed->create_time) ?></td>
            </tr>

            <tr>
                <th>修改时间</th>
                <td><?= h($activityneed->update_time) ?></td>
            </tr>
    </div>
</body>
