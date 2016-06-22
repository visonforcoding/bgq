<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            互联网
        </h1>
        <!-- <a href="#this" class='h-regiser m-sort'>默认排序</a> -->
    </div>
</header>
<div class="wraper">
    <div class="navmenu c-zindex">
         <div class="innercon">
            <a href="#this" class='h-regiser defaultsort'>默认排序</a>
            <ul>
                <li><a href="#this" class="active">全部</a></li>
               <?php foreach($sub_industries as $sub_cat):?>
                    <li><a href="/meet/meet-cat/<?=$sub_cat->id?>"><?=$sub_cat->name?></a></li>
                <?php endforeach;?>
            </ul>
            <a href="javascript:void(0);" class="morebtn"></a>
         </div>
        </div>
   <!--  <div class="navmenu">
        <div class="innercon">
            <ul>
                <li><a href="#this" class="active">全部</a></li>
                <?php foreach($sub_industries as $sub_cat):?>
                    <li><a href="/meet/meet-cat/<?=$sub_cat->id?>"><?=$sub_cat->name?></a></li>
                <?php endforeach;?>
            </ul>
            <a href="javascript:void(0);" class="morebtn"></a>
        </div>
    </div> -->
    <div id="dakas"></div>
</div>

<div class='reg-shadow' hidden="true"></div>
<div class="m-fixed-top" hidden="true">
    <ul>
        <li class="active"><a href="#this">人气推荐</a></li>
        <li><a href="#this">最新上榜</a></li>
        <li><a href="#this">评价最好</a></li>
        <li><a href="#this">约见最多</a></li>
    </ul>
</div>
</div>
<script type="text/html" id="listTpl">
    <a href="/meet/view/{#id#}">
    <section class="internet-v-info">
        <div class="innercon">
            <span class="head-img"><img src="{#avatar#}"/><i></i></span>
            <div class="vipinfo">
                <h3>{#truename#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                <div class="mark">
                    <a href="#this">演员的自我修养</a>
                    <a href="#this">如何上好一堂英语课</a>
                </div>
            </div>
        </div>
    </section>
    </a>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('dakas', 'listTpl',<?= json_encode($savants) ?>);
</script>
<?php $this->end('script'); ?>