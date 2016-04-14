<!DOCTYPE html>
<html class="ui-page-login">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
        <title></title>
        <link href="/mobile/mui/css/mui.min.css" rel="stylesheet" />
        <link href="/mobile/mui/css/style.css" rel="stylesheet" />
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <script src="/mobile/mui/js/mui.min.js"></script>
        <script src="/mobile/mui/js/mui.enterfocus.js"></script>
        <script src="/mobile/mui/js/app.js"></script>
        <script src="/js/vue.min.js"></script>
        <script>
        </script>
        <?= $this->fetch('script') ?>
    </body>
</html>