<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $pageTitle ? $pageTitle : '并购圈'; ?></title>
        <link rel="stylesheet" type="text/css" href="/pc/css/basic.css"/>
        <link rel="stylesheet" type="text/css" href="/pc/css/style.css"/>
        <script type="text/javascript" src="/mobile/js/zepto.min.js"></script>
        <script type="text/javascript" src="/mobile/js/util.js"></script>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <?= $this->fetch('script') ?>
        <div class="alert" id="alertPlan" style="display: none;"><span id="alertText"></span></div>
    </body>
</html>