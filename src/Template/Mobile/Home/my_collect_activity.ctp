<!--<header>
    <div class='inner'>
        <a href='/home/index' class='toback'></a>
        <h1>
            我的收藏
        </h1>
    </div>
</header>-->
<div class="wraper">
    <div class="inner">
        <div  class="inner my-home-menu" >
            <a href="javascript:void(0)" class="active" id="activity">活动</a>
            <a href="javascript:void(0)" id="news">资讯</a>
        </div>
    </div>
    <section class="my-collection-info" id="collect"></section>
</div>
<script type="text/html" id="activityTpl">
    <div class="innercon">
        <a href="/activity/details/{#id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items my-news-items">
                <h3>{#title#}</h3>
                <span>{#address#}<b>{#create_time#}</b> <i>{#apply_nums#}人报名</i></span>
            </div>
        </a>
    </div>
</script>
<script type="text/html" id="newsTpl">
    <div class="innercon">
        <a href="/news/view/{#news_id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#news_cover#}"/></span>
            <div class="my-collection-items my-news-items">
                <h3>{#news_title#}</h3>
                <span>{#news_user#}<b>{#create_time#}</b> <i>{#news_read#}人阅读</i></span>
            </div>
        </a>
    </div>
</script>
<?php $this->start('script'); ?>
<script>
    if(LEMON.isAPP) {
        LEMON.sys.back('/home/index');
    }
    
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/home/get-my-collect-activity",
        success: function (res) {
            if(res.status){
                $.util.dataToTpl('collect', 'activityTpl', res.data, function (d) {
                    d.id = d.activity.id;
                    d.cover = d.activity.thumb ? d.activity.thumb : d.activity.cover;
                    d.title = d.activity.title;
                    d.address = d.activity.address;
                    d.apply_nums = d.activity.apply_nums;
                    return d;
                });
            } else {
                $.util.alert(res.msg);
            }
        }
    });
    
    $('#activity').on('tap', function(){
        if($(this).hasClass('active')){
            return;
        } else {
            $('#news').removeClass('active');
            $(this).addClass('active');
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-my-collect-activity",
            success: function (res) {
                if(res.status){
                    $.util.dataToTpl('collect', 'activityTpl', res.data, function (d) {
                        d.id = d.activity.id;
                        d.cover = d.activity.thumb ? d.activity.thumb : d.activity.cover;
                        d.title = d.activity.title;
                        d.address = d.activity.address;
                        d.apply_nums = d.activity.apply_nums;
                        return d;
                    });
                } else {
                    $('#collect').html('');
                    $.util.alert(res.msg);
                }
            }
        });
    });
    
    $('#news').on('tap', function(){
        if($(this).hasClass('active')){
            return;
        } else {
            $('#activity').removeClass('active');
            $(this).addClass('active');
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-my-collect-news",
            success: function (res) {
                if(res.status){
                    $.util.dataToTpl('collect', 'newsTpl', res.data, function (d) {
                        d.news_id = d.news.id;
                        d.news_title = d.news.title;
                        d.news_read = d.news.read_nums;
                        d.news_user = d.news.admin_name;
                        d.news_cover = d.news.cover;
                        return d;
                    });
                } else {
                    $('#collect').html('');
                    $.util.alert(res.msg);
                }
            }
        });
    });
    
</script>
<?php $this->end('script');