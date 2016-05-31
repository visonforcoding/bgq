
<body>
    <header>
        <div class='inner'>
            <a class='subactivity' id="release" user="<?= $user; ?>">发布活动</a>
            <h1><?= $pagetitle ?></h1>
            <a href="/activity/search" class='iconfont news-serch h-regiser'>&#xe613;</a>
        </div>
    </header>

    <div class="wraper newswraper a-wraper">
        <div class="a-banner">
            <ul class="pic-list-container" id="imgList">
                <?php foreach ($banners as $v): ?>
                    <li><a href="<?= $v->url; ?>"><img src="<?= $v->img; ?>"/></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="yd" id="imgTab">
                <?php foreach ($banners as $v): ?>
                    <span class="cur"></span>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="activity"></div>
        <div id="buttonLoading" class="loadingbox"></div>
    </div>
</body>
<script type="text/html" id="activity_tpl">
    <section class='news-list-items'>
        <div class="active-items">
            <a href="/activity/details/{#id#}" class="a-head">
                <img src="{#cover#}"/>
                <h3>{#title#}</h3>
            </a>
            <div class="a-bottom">
                <span class="a-address">
                    {#address#}
                    {#apply_msg#}
                </span>
                <div class="a-other-info">
                    <span class="a-number">{#apply_nums#}人报名</span>
                    {#industries_name#}
                    <span class="a-date">{#time#}</span>
                </div>
            </div>
        </div>
    </section>
</script>

<script type="text/html" id="subTpl">
    <a href="#this">{#name#}</a>
</script>

<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script src="/mobile/js/activity_index.js"></script>
<script>
    window.isApply = ',' + <?= $isApply ?> + ',';
    $.util.dataToTpl('activity', 'activity_tpl',<?= $actjson ?>, function (d) {
        d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
        d.industries_name = $.util.dataToTpl('', 'subTpl', d.industries);
        return d;
    });
    
    //轮播
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span')); 
    

</script>
<?php $this->end('script');