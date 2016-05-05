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
        <?=$this->fetch('static') ?>
    </head>
    <body>
        <?=$this->fetch('content')?>
        <?=$this->fetch('script')?>
        <div class="alert" id="alertPlan"></div>
    </body>
</html>
