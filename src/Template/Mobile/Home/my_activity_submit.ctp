<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            我的活动
        </h1>

    </div>
</header>
<div class="wraper">
    <div class="h20 nobottom">
    </div>
    <div class="inner my-home-menu" >
        <a href="my-activity-submit.html">我的发布</a>
        <a href="javascript:void(0);"  class="active">已经报名</a>
                    
     </div>
    <section class="my-collection-info" id="dataBox">
    </section>
</div>
<script type="text/html" id="listTpl">
    <div class="innercon">
        <a href="/activity/detail/{#id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items">
                <h3>{#title#}</h3>
                <span>{#address#}<i class="f-color-gray">{#apply_nums#}人报名</i></span>
                <span>{#time#}</span>
            </div>
        </a>
    </div>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('dataBox', 'listTpl',<?= json_encode($activities) ?>);
</script>
<?php $this->end('script'); ?>