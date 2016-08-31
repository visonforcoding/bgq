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
        <div class='container inner'>
            <header><h3><?= $news->title ?></h3></header>
            <div contenteditable="true" spellcheck="false" class="example">
                <div class="comments">
                    <header>
                        <h3><i class="icon-comments icon-border-circle"></i> <?= $comsCount ?>条评论</h3>
                    </header>
                    <?= $comsHtml ?>
                </div>
            </div>
            <div class="reply-form" id="commentReplyForm" hidden="true">
                <div class="form">
                    <form role="form" style="padding-left:15px;">
                        <div class="form-group">
                            <textarea id="msg" class="form-control new-comment-text" rows="2" placeholder="写上你的内容..."></textarea>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary">回复</button>
                    </form>
                </div>
            </div>
            <script>
                $(function () {
                    $('.reply').on('click', function () {
                        var obj = $('#commentReplyForm');
                        var comId = $(this).data('id');
                        obj.data('id', comId);
                        $(this).parent('.actions').after(obj);
                        obj.show();
                    });
                    $('.delete').on('click', function () {
                        var comId = $(this).data('id');
                        layer.confirm('确定删除？该条评论和它的回复评论都会被删除', {
                            btn: ['确认', '取消'] //按钮
                        }, function () {
                            $.ajax({
                                type: 'post',
                                data: {id: comId},
                                dataType: 'json',
                                url: '/admin/news/coms-delete',
                                success: function (res) {
                                    layer.msg(res.msg);
                                    if (res.status) {
                                        window.location.reload();
                                    }
                                }
                            })
                        }, function () {
                        });
                    });
                    $('form').submit(function () {
                        var comId = $(this).parents('div.reply-form').data('id');
                        var body = $('#msg').val();
                        $.ajax({
                            url: '/admin/news/reply',
                            data: {id: comId, body: body},
                            dataType: 'json',
                            type: 'post',
                            success: function (res) {
                                if (res.status) {
                                    window.location.reload();
                                }
                            }
                        });
                    });
                });
            </script>
    </body>
</html>

