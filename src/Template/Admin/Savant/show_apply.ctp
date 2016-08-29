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
                        <th>申请时间</th>
                        <th>项目经验</th>
                        <th>资源优势</th>
                        <th>处理情况</th>
                        <th>审核员</th>
                        <th>审核意见</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applys as $apply): ?>
                    <tr>
                        <td><?=$apply->create_time?></td>
                        <td><?=  preg_replace('/\r|\n/', '', $apply->xmjy)?></td>
                        <td><?=  preg_replace('/\r|\n/', '', $apply->zyys)?></td>
                        <td><?=$apply->savant_str?></td>
                        <td><?=$apply->check_man?></td>
                        <td><?=$apply->reason?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </body>
</html>

