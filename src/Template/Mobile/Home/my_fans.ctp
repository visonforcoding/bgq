<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
       <h1>我的关注</h1>
        <!--<a href="javascript:void(0);" class="h-regiser h-add"></a>-->
    </div>
   
</header>
<div class="wraper" id="follow">
    <div class="h-add">
        <img src="../css/img/add1.png" alt="" />
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
</div>
<script type="text/html" id="listTpl">
    <section class="internet-v-info">
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
    </section>	
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('follow', 'listTpl',<?= json_encode($fans) ?>, function(d){
        d.fans_truename = d.fans.truename;
        d.fans_company = d.fans.company;
        d.fans_avatar = d.fans.avatar;
        d.fans_position = d.fans.position;
        d.fans_fans = d.fans.fans;
        return d;
    });
</script>
<?php $this->end('script'); ?>