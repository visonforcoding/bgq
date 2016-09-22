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
            <a href='javascript:void(0)' class='toback iconfont news-serch'>&#xe613;</a>
            <form id="searchForm" onsubmit="return false;">
            <h1><input type="text" name="keyword" placeholder="请输入关键词" value=""></h1>
            </form>
            <div class='h-regiser' id="doSearch">搜索</div>
        </div>
    </div>
    <div id="follow">

    </div>
</div>
<script type="text/html" id="listTpl">
    <section class="internet-v-info">
        
            <div class="innercon">
                <a href="/user/home-page/{#fans_id#}" ><span class="head-img"><img src="{#fans_avatar#}"/><i></i></span> </a>
                <div class="vipinfo">
                   <a href="/user/home-page/{#fans_id#}" > <h3>{#fans_truename#}<span class="meetnum"></span></h3>
                    <span class="job">{#fans_company#}&nbsp;&nbsp;{#fans_position#}</span></a>
                    <div class="mark">
                        <a href="#this">演员的自我修养</a>
                        <span class="meetnum">{#fans_fans#}人关注</span>
                    </div>
                </div>
            </div>
       
    </section>	
</script>
<script type="text/html" id="tpl">
    <a href="javascript:void(0)">{#title#}</a>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    if(LEMON.isAPP) {
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
            d.fans_subject = $.util.dataToTpl('', 'tpl', d.user.subjects);
        }
        return d;
    });
    
    $('#doSearch').on('tap', function(){
        if($('input[name="keyword"]').val() === ''){
            $.util.alert('请输入内容');
            return false;
        }
        console.log($('form').serialize());
        $.ajax({
            type: 'POST',
            data: $('form').serialize(),
            dataType: 'json',
            url: "/home/search-fans",
            success: function (res) {
                console.log(res);
                if(res.status){
                    $.util.dataToTpl('follow', 'listTpl', res.data, function(d){
                        d.following_id = d.following.id;
                        d.following_truename = d.following.truename;
                        d.following_company = d.following.company;
                        d.following_avatar = d.following.avatar ? d.following.avatar : '/mobile/images/touxiang.png';
                        d.following_position = d.following.position;
                        d.following_fans = d.following.fans;
                        d.following_subject = $.util.dataToTpl('', 'tpl', d.following.subjects);
                        return d;
                    });
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    });
</script>
<?php $this->end('script'); ?>