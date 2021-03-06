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
            <a href="/home/my-collect-activity">活动</a>
            <a href="#this"  class="active">资讯</a>
        </div>
    </div>
    <section class="my-collection-info" id="collect">
    </section>	
</div>
<script type="text/html" id="listTpl">
    <div class="innercon">
        <a href="/news/view/{#news_id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#news_cover#}"/></span>
            <div class="my-collection-items my-news-items">
                <h3>{#news_title#}</h3>
                <span>{#news_user#}<b>{#create_str#}</b> <i>{#news_read#}人阅读</i></span>
            </div>
        </a>
    </div>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
    $.util.dataToTpl('collect', 'listTpl',<?= json_encode($collects) ?>, function(d){
        d.news_id = d.news.id;
        d.news_title = d.news.title;
        d.news_read = d.news.read_nums;
        d.news_user = d.news.admin_name;
        d.news_cover = d.news.cover;
        return d;
    });
</script>
<?php $this->end('script'); ?>