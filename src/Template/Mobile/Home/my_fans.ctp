<!--<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>我的粉丝</h1>
        <a href="javascript:void(0);" class="h-regiser h-add"></a>
    </div>
</header>-->
<div class="wraper">
    <div class="h-add" style='display:none'>
        <img src="/mobile/images/add1.png" alt="" />
    </div>
    <div  class="inner my-home-menu" >
        <a href="/home/my-following" >我的关注</a>
        <a href="/home/my-fans" class="active">我的粉丝</a>
    </div>
    <div class="my-focus-box">
        <div class='inner my-search'>
            <a href='#this' class='toback iconfont news-serch'>&#xe613;</a>
            <h1><input type="text" placeholder="请输入关键词"></h1>
        </div>
    </div>
    <div id="follow">

    </div>
</div>
<script type="text/html" id="listTpl">
    <section class="internet-v-info">
        <a href="/user/home-page/{#fans_id#}" >
            <div class="innercon">
                <span class="head-img"><img src="{#fans_avatar#}"/><i></i></span>
                <div class="vipinfo">
                    <h3>{#fans_truename#}<span class="meetnum"></span></h3>
                    <span class="job">{#fans_company#}&nbsp;&nbsp;{#fans_position#}</span>
                    <div class="mark">
                        <a href="#this">演员的自我修养</a>
                        <span class="meetnum">{#fans_fans#}人关注</span>
                    </div>
                </div>
            </div>
        </a>
    </section>	
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
    $.util.dataToTpl('follow', 'listTpl',<?= json_encode($fans) ?>, function (d) {
        if (d) {
            d.fans_truename = d.user.truename;
            d.fans_company = d.user.company;
            d.fans_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
            d.fans_position = d.user.position;
            d.fans_fans = d.user.fans;
            d.fans_id = d.user.id;
        }
        return d;
    });
</script>
<?php $this->end('script'); ?>