<header>
    <div class='inner'>
        <h1>资讯</h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
    </div>
</header>
<div class="wraper newswraper">
    <div class="a-banner">
        <ul class="pic-list-container" id="imgList">
            <?php foreach ($banners as $banner):?>
            <li><a href="<?=$banner->url?>"><img src="<?=$banner->img?>"/></a></li>
            <?php endforeach;?>
        </ul>
        <div class="yd" id="imgTab">
            <span class="cur"></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="news"></div>
</div>

<script type="text/html" id="listTpl">
    <section class='news-list-items '>
        <h1 class="firstnews"><span><img src="/mobile/images/user.png" /></span>{#admin_name#}</h1>
        <a href="/mobile/news/view/{#id#}" class="newsbox clearfix">
            <div class="sec-news-l">
                <h3>{#title#}</h3>
                <p>{#summary#}</p>
            </div>	
            <div class="sec-news-r">
                <img src="{#cover#}"/>
            </div>
        </a>
        <div class="news-bottom clearfix">
            <div class="sec-b-l">
                <div class="sec-like">
                    <span class="iconfont">&#xe616;</span>{#praise_nums#}
                </div>
                <div class="sec-comment">
                    <span class="iconfont">&#xe618;</span>{#comment_nums#}
                </div>
            </div>
            <div class="sec-b-r">
                <a href="#this">投资</a>
                <a href="#this">资金</a>
                <a href="#this">管理</a>
            </div>
        </div>
    </section>	
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('news', 'listTpl',<?= $newsjson ?>);
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'));
</script>
<?php $this->end('script'); ?>