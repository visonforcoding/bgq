<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>查看个人信息</title>
        <link rel="stylesheet" href="/wpadmin/lib/zui/css/zui.min.css" />
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
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control new-comment-text" rows="2" placeholder="write a comment..."></textarea>
                        </div>
                </div>
            </div>
    </body>
</html>

