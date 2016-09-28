<link rel="stylesheet" type="text/css" href="/mobile/css/zt.css"/>
<div class="wraper">
    <!--banner-->
    <div class="a_search_box">
        <a href="/beauty/search"><i class="iconfont">&#xe618;</i></a>
    </div>
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
                <!--<li><a href="#this"><img src="/mobile/images/a-banner.png"/></a></li>-->
            <li><a href="javascript:void(0)"><img src="/upload/banner/2016-09-22/57e38e4ad7cb6.jpg"/></a></li>
            <!--<li><a href="#this"><img src="/mobile/images/a-banner.png"/></a></li>-->
        </ul>
    </div>
    <!--banner__end-->
    <!--选男神女神-->
    <div class="z_tab_head">
        <ul>
            <li class="active">
                <span>选女神</span>
            </li>
            <li><span>选男神</span></li>
        </ul>
        <span class="z_line"></span>
    </div>
    <script type="text/javascript">
        $('.z_tab_head li').on('tap', function () {
            var index = $(this).index();
            var left1 = index * 50;
            $(this).addClass('active').siblings().removeClass();
            $('.z_line').css('left', left1 + '%');
            $('.z_tab_box').css('left', -left1 * 2 + '%');

        })
    </script>
    <div class="z_tab_con">
        <div class="z_tab_box">
            <section class="z_items content_inner" id="female">
                
            </section>
            <section class="z_items content_inner" id="male">
                
            </section>
        </div>
    </div>
</div>
<script type="text/html" id="tpl">
    <dl>
        <a href="/beauty/homepage/{#id#}">
            <dt class="posi_top"><img src="{#pic#}" alt="" /><span></span><i>{#beauty_id#}</i></dt>
            <dd class="zt_name"><span class="p_name color-items mr10">{#username#}</span><span class="p_job color-gray">{#position#}</span></dd>
            <dd class="zt_commpany">{#company#}</dd>
        </a>
        <dd class="mt20"><span class="zt_num color-items fl">{#vote_nums#}票</span><span class="fr zt_r_btn vote" user_id="{#user_id#}">投 票</span></dd>
    </dl>
</script>
<?php $this->start('script'); ?>
<script type="text/javascript">
    $('.rule').on('tap', function () {
        $('.zt_tips').addClass('zt_tips_show');
        $('body').css({'overflow': 'hidden', 'height': '100%'});
        $('html').css({'overflow': 'hidden', 'height': '100%'});
    });
    $('.zt_r_closed').on('tap', function () {
        $('.zt_tips').removeClass('zt_tips_show');
        $('body').css({'overflow': 'auto', 'height': 'auto'})
        $('html').css({'overflow': 'auto', 'height': 'auto'})
    });

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/beauty/get-female-beauty",
        success: function (res) {
            if (res.status) {
                $.util.dataToTpl('female', 'tpl', res.data, function (d) {
                    d.position = d.user.position;
                    d.company = d.user.company;
                    d.username = d.user.truename;
                    d.user_id = d.user.id;
                    d.pic = d.beauty_pics.length ? d.beauty_pics[0].pic_url : '';
                    return d;
                });
                $('.vote').on('tap', function(){
                    var obj = $(this);
                    $.util.ajax({
                        url: '/beauty/vote/'+obj.attr('user_id'),
                        func: function(res){
                            if(res.status){
                                obj.prev('span.zt_num').html(parseInt(obj.prev('span.zt_num').html())+1+'票');
                            } else {
                                $.util.alert(res.msg);
                            }
                        }
                    });
                });
            }
        }
    });
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/beauty/get-male-beauty",
        success: function (res) {
            if (res.status) {
                $.util.dataToTpl('male', 'tpl', res.data, function (d) {
                    d.position = d.user.position;
                    d.company = d.user.company;
                    d.username = d.user.truename;
                    d.user_id = d.user.id;
                    d.pic = d.beauty_pics.length ? d.beauty_pics[0].pic_url : '';
                    return d;
                });
                $('.vote').on('tap', function(){
                    var obj = $(this);
                    $.util.ajax({
                        url: '/beauty/vote/'+obj.attr('user_id'),
                        func: function(res){
                            if(res.status){
                                obj.prev('span.zt_num').html(parseInt(obj.prev('span.zt_num').html())+1+'票');
                            } else {
                                $.util.alert(res.msg);
                            }
                        }
                    });
                });
            }
        }
    });


</script>
<?php
$this->end('script');
