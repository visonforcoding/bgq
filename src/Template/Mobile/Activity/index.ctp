
<body>
    <div class="wraper a-wraper">
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
            <div class="a-search-box">
                <div class="a-search">
                    <i class="iconfont">&#xe613;</i>
                    <div class="s-con">
                        <input type="text" placeholder="请输入关键词" class="search"/>
                    </div>
                </div>
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
    <a href="javascript:void(0);">{#name#}</a>
</script>
<div class="submitbtn subactivity" id="release" user="<?= $user; ?>">
    <span>发布<br />活动</span>
</div>
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

    $('.s-con').click(function () {
        $('.search').focus();
    });

    $('.search').focus(function () {
        location.href = "/activity/search";
    });
</script>
<?php
$this->end('script');
