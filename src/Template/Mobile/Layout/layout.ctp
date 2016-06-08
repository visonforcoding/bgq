<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection"content="telephone=no, email=no" />
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title><?=  isset($pageTitle)?$pageTitle:'并购圈'?></title>
        <link rel="stylesheet" type="text/css" href="/mobile/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="/mobile/css/style.css"/>
        <script src="/mobile/js/zepto.min.js"></script>
        <script src="/mobile/js/view.js"></script>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->element('header'); ?>
        <?= $this->fetch('content') ?>
        <script src="/mobile/js/util.js"></script>
        <script src="/mobile/js/function.js"></script>
        <script>
            if(window.location.href.indexOf('activity') != -1)
            {
                $('.activity_icon').css({color:'#dd204b'});
                $('.activity_icon span').css({color:'#dd204b'});
            }
            else if(window.location.href.indexOf('meet') != -1)
            {
                $('.meet_icon').css({color:'#dd204b'});
                $('.meet_icon span').css({color:'#dd204b'});
            }
            else if(window.location.href.indexOf('home') != -1)
            {
                $('.home_icon').css({color:'#dd204b'});
                $('.home_icon span').css({color:'#dd204b'});
            }
            else
            {
                $('.news_icon').css({color:'#dd204b'});
                $('.news_icon span').css({color:'#dd204b'});
            }
            if(window.location.href.indexOf('index') != -1)
            {
                $('.toback').hide();
            }
        </script>
        <?= $this->fetch('script') ?>
        <div class="alert" id="alertPlan" style="display: none"><span id="alertText"></span></div>
    </body>
</html>
