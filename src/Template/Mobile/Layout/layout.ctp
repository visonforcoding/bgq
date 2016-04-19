<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>FrozenUI Demo</title>
        <link rel="stylesheet" href="/mobile/frozenui/css/frozen.css">
        <?= $this->fetch('static') ?>
    </head>
    <body ontouchstart="">
        <?php if ($this->fetch('header')): ?>
            <?= $this->fetch('header') ?>
        <?php else: ?>
            <?= $this->element('header') ?>
        <?php endif; ?>
        <footer class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li data-href="index.html" class="ui-border-r"><div>基础样式</div></li>
                <li data-href="ui.html" class="ui-border-r"><div>UI组件</div></li>
                <li data-href="js.html"><div>JS插件</div></li>
            </ul>
        </footer>
        <section class="ui-container ui-center">
            <?= $this->fetch('content') ?>
        </section>
        <script src="/mobile/frozenui/lib/zepto.min.js"></script>
        <script src="/mobile/frozenui/js/frozen.js"></script>
        <?= $this->fetch('script') ?>
    </body>
</html>