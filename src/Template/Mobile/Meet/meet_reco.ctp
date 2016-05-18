<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            大咖推荐
        </h1>
    </div>
</header>
<div class="wraper" id="dakas">
</div>
<script type="text/html" id="listTpl">
    <section class="internet-v-info">
        <a href="/meet/view/{#id#}"/>
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
        </a>
    </section>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('dakas', 'listTpl',<?= $dakas ?>);
</script>
<?php $this->end('script'); ?>