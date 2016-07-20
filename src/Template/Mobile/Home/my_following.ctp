<div class="wraper">
<!--    <div class="h-add">
        <img src="/mobile/images/add1.png" alt="" />
    </div>-->
     <div  class="inner my-home-menu" >
        <a href="javascript:void(0)" class="active" id="myFollowing">我的关注</a>
        <a href="javascript:void(0)" id="myFans">我的粉丝</a>     
     </div>
            
    <div class="my-focus-box">
        <div class='inner my-search'>
            <a href='javascript:void(0)' class='toback iconfont news-serch'>&#xe613;</a>
            <form id="searchForm" style="width: 100%" >
            <h1><input type="text" name="keyword" placeholder="请输入关键词" value=""></h1>
            <input type="hidden" name="type" value="1" id="type" />
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
            <a href='/user/home-page/{#following_id#}'><span class="head-img"><img src="{#following_avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/user/home-page/{#following_id#}">
                    <h3>{#following_truename#}<span class="meetnum"></span></h3>
                    <span class="job">{#following_company#}&nbsp;&nbsp;{#following_position#}</span>
                </a>
                <div class="mark">
                    {#following_subject#}
                    <span class="meetnum">{#following_fans#}人关注</span>
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
    
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/home/get-my-following",
        success: function (res) {
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
    
    
    
    $('#doSearch').on('tap', function(){
        search();
    });
    
    $('#searchForm').on('submit', function(){
        search();
        return false;
    });
    
    $('#myFollowing').on('tap', function (){
        if($(this).hasClass('active')){
            return;
        } else {
            $('#myFans').removeClass('active');
            $(this).addClass('active');
            $('input[name="type"]').val(1);
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-my-following",
            success: function (res) {
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
    $('#myFans').on('tap', function (){
        if($(this).hasClass('active')){
            return;
        } else {
            $('#myFollowing').removeClass('active');
            $(this).addClass('active');
            $('input[name="type"]').val(2);
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-my-fans",
            success: function (res) {
                if(res.status){
                    $.util.dataToTpl('follow', 'listTpl', res.data, function(d){
                        d.following_id = d.user.id;
                        d.following_truename = d.user.truename;
                        d.following_company = d.user.company;
                        d.following_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                        d.following_position = d.user.position;
                        d.following_fans = d.user.fans;
                        d.following_subject = $.util.dataToTpl('', 'tpl', d.user.subjects);
                        return d;
                    });
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    });
    
    // 搜索
    function search(){
        if($('input[name="keyword"]').val() === ''){
            $.util.alert('请输入内容');
            return false;
        }
        $.ajax({
            type: 'POST',
            data: $('form').serialize(),
            dataType: 'json',
            url: "/home/my-following-search",
            success: function (res) {
                if(res.status){
                    if($('input[name="type"]').val() == 1){
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
                        $.util.dataToTpl('follow', 'listTpl', res.data, function(d){
                            d.following_id = d.user.id;
                            d.following_truename = d.user.truename;
                            d.following_company = d.user.company;
                            d.following_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            d.following_position = d.user.position;
                            d.following_fans = d.user.fans;
                            d.following_subject = $.util.dataToTpl('', 'tpl', d.user.subjects);
                            return d;
                        });
                    }
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    }
    
    
</script>
<?php $this->end('script');
