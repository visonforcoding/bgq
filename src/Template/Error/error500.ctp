<?php

use Cake\Core\Configure;
use Cake\Error\Debugger;
?>
<?php $this->set(['pageTitle' => '出错了']) ?>
<?php $this->layout = 'layout'; ?>
<?php if (!Configure::read('debug')): ?>
<script type="text/javascript" src="/mobile/js/jsapi.js"></script>
    <header>
        <div class='inner'>
            <a href='javascript:history.go(-1);' class='toback'></a>
            <h1>404</h1>
        </div>
    </header>
    <!--<div class="wraper">
        <div class="errorpage">
            <a href='javascript:void(0);'></a>
        </div>
        <p class="ptips">可能原因：网络信号弱，<em>找不到请求页面</em></p>
        <div class='btnlist'>
            <a href="javascript:location.reload()"><i></i>刷新</a><a href="/"><i></i>主页</a><a href="javascript:history.go(-1);"><i></i>返回</a>
        </div>
    </div>-->
    <div class="wraper">
        <div class="errorpage n_err">
            <a href="javascript:void(0);"></a>
        </div>
        <p class="ptips">您所查看的内容已经不存在或被删除
        </p>

        <div class="btnlist n_err_btn">
            <a href="javascript:location.href='/<?= $this->requset->url ?>';"><i></i>刷新</a><a href="/"><i></i>主页</a><a href="javascript:LEMON.event.back();"><i></i>返回</a>
        </div>
    </div>
<?php else: ?>
    <?php
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
    <?php endif; ?>
    <?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
    <?php endif; ?>
    <?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
    ?>
    <h2><?= __d('cake', 'An Internal Error Has Occurred') ?></h2>
    <p class="error">
        <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= h($message) ?>
    </p>
<?php endif;

