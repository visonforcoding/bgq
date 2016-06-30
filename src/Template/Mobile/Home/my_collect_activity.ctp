<header>
    <div class='inner'>
        <a href='/home/index' class='toback'></a>
        <h1>
            我的收藏
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="inner">
        <div  class="inner my-home-menu" >
            <a href="#this" class="active">活动</a>
            <a href="/home/my-collect-news">资讯</a>
        </div>
    </div>
    <section class="my-collection-info" id="activity"></section>
</div>
<script type="text/html" id="listTpl">
    <div class="innercon">
        <a href="/activity/details/{#id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items">
                <h3>{#title#}</h3>
                <span>{#address#}</span>
                <span>{#time#} <i>{#apply_nums#}人报名</i></span>
            </div>
        </a>
    </div>
</script>
<?php $this->start('script'); ?>
<script>
    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
    
    $.util.dataToTpl('activity', 'listTpl',<?= $activityjson ?>, function (d) {
        d.id = d.activity.id;
        d.cover = d.activity.thumb ? d.activity.thumb : d.activity.cover;
        d.title = d.activity.title;
        d.address = d.activity.address;
        d.time = d.activity.time;
        d.apply_nums = d.activity.apply_nums;
        return d;
    });
</script>
<?php $this->end('script');