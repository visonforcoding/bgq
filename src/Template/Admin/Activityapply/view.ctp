<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>查看个人信息</title>
        <link rel="stylesheet" href="/wpadmin/lib/zui/css/zui.min.css" />
        <script src="/wpadmin/js/jquery.js"></script>
        <script src="/wpadmin/lib/layer/layer.js"></script>
    </head>
    <body>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>电话</th>
                        <th>公司</th>
                        <th>职位</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($companions as $k=>$v): ?>
                    <tr>
                        <td><?= $v->name ?></td>
                        <td><?= $v->phone ?></td>
                        <td><?= $v->company ?></td>
                        <td><?= $v->position ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </body>
</html>