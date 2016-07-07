<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            历史消息
        </h1>

    </div>
</header>
<div class="wraper">
    <ul class="history-info" id="follow">
    </ul>
</div>
<script type="text/html" id="listTpl">
    <li>
        <div class="innercon">
            <span class="color-items">{#create_time#}</span>
            <p>{#msg#}</p>
        </div>
    </li>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('follow', 'listTpl',<?= json_encode($needs) ?>, function (d) {
        if(d.pid != 0){
            d.msg = '小秘书回复：' + d.msg;
        }
        return d;
    });
</script>
<?php $this->end('script'); ?>