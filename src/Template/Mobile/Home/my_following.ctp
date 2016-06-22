<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
           我的活动
        </h1>
        <!-- <a href="javascript:void(0);" class="h-regiser h-add"></a> -->
    </div>
   
</header>
<div class="wraper">
    <div class="h-add">
        <img src="/img/add1.png" alt="" />
    </div>
     <div  class="inner my-home-menu" >
        <a href="my-onfocus.html" >我的关注</a>
        <a href="my-fans.html" class="active">我的粉丝</a>     
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
        <div class="innercon">
            <span class="head-img"><img src="{#following_avatar#}"/><i></i></span>
            <div class="vipinfo">
                <h3>{#following_truename#}<span class="meetnum"></span></h3>
                <span class="job">{#following_company#}&nbsp;&nbsp;{#following_position#}</span>
                <div class="mark">
                    <a href="#this">演员的自我修养</a>
                    <span class="meetnum">{#following_fans#}人关注</span>
                </div>
            </div>
        </div>
    </section>	
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('follow', 'listTpl',<?= json_encode($followings) ?>, function(d){
        d.following_truename = d.following.truename;
        d.following_company = d.following.company;
        d.following_avatar = d.following.avatar;
        d.following_position = d.following.position;
        d.following_fans = d.following.fans;
        return d;
    });
</script>
<?php $this->end('script'); ?>