<div class="wraper">
<!--    <div class="h-add">
        <img src="/mobile/images/add1.png" alt="" />
    </div>-->
     <div  class="inner my-home-menu" >
        <a href="javascript:void(0)" id="myFollowing">我的关注</a>
        <a href="javascript:void(0)" id="myFans">我的粉丝</a>     
     </div>
            
    <div class="my-focus-box">
        <div class='h-news-search'>
            <a href='javascript:void(0)' class='iconfont news-serch'>&#xe601;</a>
            <form id="searchForm">
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
    <section class="internet-v-info mt20">
        <div class="innercon">
            <a href='/user/home-page/{#following_id#}'><span class="head-img"><img src="{#following_avatar#}"/>{#v#}</span></a>
            <div class="vipinfo">
                <a href="/user/home-page/{#following_id#}">
                    <h3>{#following_truename#}<span class="meetnum">{#following_fans#}人关注</span></h3>
                    <span class="job">{#following_company#}&nbsp;&nbsp;{#following_position#}</span>
                </a>
                <div class="mark s_mark_h">
                    {#following_subject#}
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
    var type = '<?= $type ?>';
</script>
<script>
    
    if(type == 2){
        myFansTap($('#myFans').get(0));
    } else {
        myFollowingTap($('#myFollowing').get(0));
    }
    
    $('#doSearch').on('tap', function(){
        search();
    });
    
    $('#searchForm').on('submit', function(){
        search();
        return false;
    });
    
    $('#myFollowing').on('tap', function (){
        myFollowingTap(this);
    });
    
    function myFollowingTap(em){
        if($(em).hasClass('active')){
            return;
        } else {
            $('#myFans').removeClass('active');
            $(em).addClass('active');
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
                        if(d.following.level == 2){
                            d.v = '<i></i>';
                        }
                        return d;
                    });
                } else {
                    $('#follow').html('<div class="nocontent"><i class="iconfont">&#xe687;</i><span>你还没有任何关注</span></div>');
                }
            } 
        });
    }
    
    $('#myFans').on('tap', function (){
        myFansTap(this);
    });
    
    function myFansTap(em){
        if($(em).hasClass('active')){
            return;
        } else {
            $('#myFollowing').removeClass('active');
            $(em).addClass('active');
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
                        if(d.user.level == 2){
                            d.v = '<i></i>';
                        }
                        return d;
                    });
                } else {
                    $('#follow').html('<div class="nocontent"><i class="iconfont">&#xe688;</i><span>你还没有任何粉丝</span></div>');
                }
            }
        });
    }
    
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
                            if(d.following.level == 2){
                                d.v = '<i></i>';
                            }
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
                            if(d.user.level == 2){
                                d.v = '<i></i>';
                            }
                            return d;
                        });
                    }
                } else {
                    $('#follow').html('');
                    $.util.alert(res.msg);
                }
            }
        });
    }
    
    
</script>
<?php $this->end('script');
