<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= isset($pageTitle) ? $pageTitle : '并购帮'; ?></title>
        <link rel="stylesheet" type="text/css" href="/pc/css/basic.css"/>
        <link rel="stylesheet" type="text/css" href="/pc/css/style.css"/>
        <script type="text/javascript" src="/mobile/js/zepto.min.js"></script>
        <script type="text/javascript">
            (function(win){var h;var docEl=document.documentElement;function setUnitA(){var clientWidth=docEl.clientWidth;if(!clientWidth){return}if(clientWidth>750){docEl.style.fontSize=100+"px"}else{docEl.style.fontSize=100*(clientWidth/750)+"px"}}win.addEventListener("resize",function(){clearTimeout(h);h=setTimeout(setUnitA,300)},false);win.addEventListener("pageshow",function(e){if(e.persisted){clearTimeout(h);h=setTimeout(setUnitA,300)}},false);setUnitA()})(window);
        </script>
        <script type="text/javascript" src="/mobile/js/util.js"></script>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <?= $this->fetch('script') ?>
        <div class="alert" id="alertPlan" style="display: none;"><span id="alertText"></span></div>
    </body>
</html>