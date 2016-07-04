<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $pageTitle ? $pageTitle : '并购圈'; ?></title>
        <link rel="stylesheet" type="text/css" href="/pc/css/basic.css"/>
        <link rel="stylesheet" type="text/css" href="/pc/css/style.css"/>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <?= $this->fetch('script') ?>
    </body>
</html>