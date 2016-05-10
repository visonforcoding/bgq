<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection"content="telephone=no, email=no" />
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>并购圈</title>
        <link rel="stylesheet" type="text/css" href="/mobile/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="/mobile/css/style.css"/>
        <script src="/mobile/js/zepto.min.js"></script>
        <script src="/mobile/js/view.js"></script>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <?php if ($this->fetch('footer')): ?>
            <footer class="footer">
                <ul class="navfooter clearfix">
                    <li>
                        <span class="iconfont">&#xe601;</span>
                        <a href="#this">活动</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe609;</span>
                        <a href="/news/index">资讯</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe60b;</span>
                        <a href="#this">大咖</a>
                    </li>
                    <li>
                        <span class="iconfont">&#xe60d;</span>
                        <a href="/home/index">我</a>
                    </li>
                </ul>
            </footer>
        <?php endif; ?>
        <script src="/mobile/js/util.js"></script>
        <?= $this->fetch('script') ?>
        <div class="alert" id="alertPlan"></div>
    </body>
</html>
