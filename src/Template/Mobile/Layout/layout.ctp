<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection"content="telephone=no, email=no" />
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title><?= isset($pageTitle) ? $pageTitle : '并购圈' ?></title>
        <link rel="stylesheet" type="text/css" href="/mobile/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="/mobile/css/style.css"/>
        <script src="/mobile/js/zepto.min.js"></script>
        <script src="/mobile/js/view.js"></script>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <script src="/mobile/js/jsapi.js"></script>
        <script src="/mobile/js/util.js"></script>
        <script src="/mobile/js/function.js"></script>
        <script>

            if(!/smartlemon|micromessenger/.test(navigator.userAgent.toLowerCase())){
                $('header').show();
            }else{
                $($('.wraper')[0]).css('padding-top','0');
            }

            if(navigator.userAgent.toLowerCase().indexOf('smartlemon') == -1){
                $('footer').show();
                //$('.wraper').addClass('newswraper');
            }
        </script>
        <?= $this->fetch('script') ?>
        <div class="alert" id="alertPlan" style="display: none"><span id="alertText"></span></div>
    </body>
</html>
