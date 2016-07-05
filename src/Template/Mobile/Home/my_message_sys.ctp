<header>
    <div class='inner'>
        <a href='/home/index' class='toback'></a>
        <h1>我的消息</h1>
        <!--<a href="javascript:void(0);" class="h-regiser h-add"></a>-->
    </div>
</header>
<div class="wraper" >
    <div class="inner my-home-menu m-message-top" >
        <a href="/home/my-message-fans" >新的关注<?php if($unReadFollowCount): ?><i><?= $unReadFollowCount ?></i><?php endif; ?></a>
        <a href="/home/my-message-sys" class="active">系统消息<?php if($unReadSysCount): ?><i><?=$unReadSysCount?></i><?php endif; ?></a>
    </div>
    <ul class="systerm-info-box" id="msgs">
    </ul>
</div>
<script type="text/html" id="listTpl">
    <li>
        <div>
            <h3>{#title#}</h3>
            <span>{#msg#}</span>
            <span class='datetime'>{#create_time#}</span>
        </div>
        <a href="{#jump_url#}">查看详情</a>
    </li>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('msgs', 'listTpl',<?= json_encode($msgs) ?>, function (d) {     
            d.jump_url  = d.url?d.url:'#this';
        return d;
    });
</script>
<?php $this->end('script'); ?>