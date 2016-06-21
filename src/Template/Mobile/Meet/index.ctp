<!--<header>
    <div class='inner'>
        <h1>
            专家约见
        </h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
    </div>
</header>-->

<div class="wraper newswraper">
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
            <?php foreach ($banners as $k=>$v): ?>
            <li><a href="<?= $v['url'] ?>"><img src="<?= $v['img'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="yd" id="imgTab">
            <?php foreach ($banners as $v): ?>
            <span></span>
            <?php endforeach; ?>
        </div>
        <div class="a-search-box" id="search">
            <div class="a-search">
                <i class="iconfont">&#xe613;</i>
                <div class="s-con">
                    <input type="text" placeholder="请输入关键词" class='search'/>
                </div>
            </div>
        </div>
    </div>
    <!--分类--start-->
    <div class="menusort clearfix">
        <div class="allmenu">
            <div class="menulist clearfix" id="allsort">
                <a href="javascript:void(0)" id='sort_1' sort='1'>
                    <i class="iconfont">&#xe600;</i>
                    <span>互联网</span>
                </a>
                <a href="javascript:void(0)" id='sort_2' sort='2'>
                    <i class="iconfont">&#xe602;</i>
                    <span>金融</span>
                </a>
                <a href="javascript:void(0)" id='sort_3' sort='3'>
                    <i class="iconfont">&#xe601;</i>
                    <span>健康医疗</span>
                </a>
                <a href="javascript:void(0)" id='sort_4' sort='4'>
                    <i class="iconfont">&#xe603;</i>
                    <span>艺术</span>
                </a>
                <a href="javascript:void(0)" id='sort_5' sort='5'>
                    <i class="iconfont">&#xe604;</i>
                    <span>餐饮</span>
                </a>
                <a href="javascript:void(0)" id='sort_6' sort='6'>
                    <i class="iconfont">&#xe605;</i>
                    <span>养生</span>
                </a>
                <a href="javascript:void(0)" id='sort_7' sort='7'>
                    <i class="iconfont">&#xe606;</i>
                    <span>保险</span>
                </a>
                <a href="javascript:void(0)" id='sort_8' sort='8'>
                    <i class="iconfont">&#xe607;</i>
                    <span>汽车</span>
                </a>
                <a href="/meet/moreIndustries">
                    <i class="iconfont">&#xe608;</i>
                    <span>更多</span>
                </a>
            </div>
        </div>
        <a href="javascript:void(0);" class="sele-r"></a>
    </div>
    <!--分类--end-->
    
    <div class="dk">
        <ul>
            <li><a href="/meet/view/"><img src="/mobile/images/dk.jpg"/><span>8人见过</span></a></li>
        </ul>
    </div>
    <div id='biggie'></div>
</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/meet/view/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/meet/view/{#id#}">
                    <h3>{#truename#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark">
                    {#subjects#}
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="javascript:void(0);">{#title#}</a>
</script>
<?=$this->element('footer');?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script src="/mobile/js/meet_index.js"></script>
<script>
    $.util.dataToTpl('biggie', 'biggie_tpl',<?= $meetjson ?>, function (d) {
        d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
        return d;
    });
    
    //轮播
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'));
    $('.s-con').click(function () {
        $('.search').focus();
    });

    $('.search').focus(function () {
        location.href = "/meet/search";
    });
    
    $.util.searchHide();
    
    if($.util.isAPP)
    {
        $('#search').hide();
        LEMON.show.search();
    }
    
</script>
<?php $this->end('script');