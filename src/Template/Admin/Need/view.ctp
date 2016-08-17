<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>查看个人信息</title>
        <link rel="stylesheet" href="/wpadmin/lib/zui/css/zui.min.css" />
        <link rel="stylesheet" href="/wpadmin/css/chat.css" />
        <script src="/wpadmin/js/jquery.js"></script>
        <script src="/wpadmin/lib/zui/js/zui.min.plus.js"></script>
        <script src="/wpadmin/lib/layer/layer.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="accordion">
                            <span class="glyphicon glyphicon-comment"></span> 小秘书
                            <div class="btn-group pull-right">
                                <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                            </div>
                        </div>
                        <div class="panel-collapse collapse" style='display:block' id="collapseOne">
                            <div class="panel-body">
                                <ul class="chat">
                                    <?php foreach ($needs as $need): ?>
                                        <?php if ($need->reply_id > 0): ?>
                                            <li class="right clearfix"><span class="chat-img pull-right">
                                                    <img src="<?= getAvatar($need->user->avatar) ?>" alt="User Avatar" class="img-circle" />
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div style=" overflow:hidden" class="header">
                                                        <!--<small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?= $need->create_time ?></small>-->
                                                        <strong class="pull-right primary-font"><?= $need->user->truename ?> <?= $need->user->company ?> <?= $need->user->position ?></strong>
                                                    </div>
                                                    <div style=" overflow: hidden">
                                                        <p class="pull-right">
                                                            <?= $need->msg ?>
                                                        </p>
                                                    </div>
                                                    <small style="display: block;float: right"  class=" text-muted"><span class="glyphicon glyphicon-time"></span><?= $need->create_time ?></small>
                                                </div>
                                            </li>
                                        <?php else: ?>
                                            <li class="left clearfix"><span class="chat-img pull-left">
                                                    <img src="<?= getAvatar($need->user->avatar) ?>" alt="User Avatar" class="img-circle" />
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font"><?= $need->user->truename ?> <?= $need->user->company ?> <?= $need->user->position ?></strong> 
                                                        <!--<small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span><?= $need->create_time ?></small>-->
                                                    </div>
                                                        <p>
                                                            <?= $need->msg ?>
                                                        </p>
                                                        
                                                    <small style="display: block;" class="text-muted"><span class="glyphicon glyphicon-time"></span><?= $need->create_time ?></small>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="panel-footer">
                                <div class="input-group">
                                    <input id="msg" type="text" class="form-control " placeholder="这里输入回复内容..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-warning" id="btn-chat">
                                            回复</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                $('#btn-chat').on('click', function () {
                    var msg = $('#msg').val();
                    if (!msg) {
                        layer.msg('回复的内容不可以回空哦');
                        return;
                    }
                    $.ajax({
                        type: 'post',
                        data: {msg: msg},
                        dataType: 'json',
                        url: '/admin/need/reply/<?= $id ?>',
                        success: function (res) {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
    </body>
</html>

