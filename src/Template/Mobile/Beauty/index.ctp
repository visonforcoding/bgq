<link rel="stylesheet" type="text/css" href="/mobile/css/zt.css"/>
<div class="wraper">
    <!--banner-->
    <div class="a_search_box">
        <a href="/beauty/search"><i class="iconfont">&#xe618;</i></a>
    </div>
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
                <!--<li><a href="#this"><img src="/mobile/images/a-banner.png"/></a></li>-->
            <li><a href="javascript:void(0)"><img src="<?= createImg('/upload/beauty/550912168776455995.jpg') ?>?w=414&h=210"/></a></li>
            <!--<li><a href="#this"><img src="/mobile/images/a-banner.png"/></a></li>-->
        </ul>
    </div>
    <!--banner__end-->
    <!--活动介绍-->
    <div class="z_top_intro">
        <div class='z_top_title innercon clearfix'>
            <h3 class="fl color-items">活动介绍</h3>
            <span class="fr col-lblue rule">活动规则</span>
        </div>
        <div class='z_top_con p20 bd2 bd1'>
            <div class="content_inner">
                <p>由并购帮主办的“2016并购菁英评选”活动于10月8日启动，本次活动将评选出“十大产业菁英”、“十大金融菁英”和“十大顾问菁英”，参与并购项目各个环节的角色，如上市公司、投资机构、银行、券商、投行等，都可以报名参加。
                </p></div>
        </div>
    </div>
    <!--活动介绍 end-->
    <!--top 10-->
    <div class="z_tab_head">
        <ul>
            <?php foreach ($votingType as $k => $v): ?>
                <li <?php if ($k == 1): ?>class="active"<?php endif; ?>><span><?= $v ?></span></li>
            <?php endforeach; ?>
        </ul>
        <span class="z_line"></span>
    </div>
    <script type="text/javascript">
        var tabheight = $('.z_tab_head').offset().top;
        $('.z_tab_head li').on('tap', function () {
            tap(this);
        });
        
        function tap(em){
            var index = $(em).index();
            var hei = $('.z_items').eq(index).height();
            var minHeight = window.screen.height - $('.z_tab_head').height() - 30;
            $(em).addClass('active').siblings().removeClass();
            $('.z_line').css('left', index * 33.33 + '%');
            $('.z_tab_box').css({'left': -index * 100 + '%'});
            $('.z_tab_con').css({'height': hei + 'px', 'min-height': minHeight});
        }
        
        //tab选项卡固定
        $(window).on('scroll', function () {
            var scrollTop = document.body.scrollTop;
            if (scrollTop >= tabheight-10) {
                $('.z_tab_head').addClass('z_tab_head_fix');
                $('.wraper').css({'padding-top':'.8rem'})
            } else {
                $('.z_tab_head').removeClass('z_tab_head_fix');
                $('.wraper').css({'padding-top':'0'})
            }
            
        });
    </script>
    <!--top 10-end->
    <!---->
    <div class="z_tab_con">
        <div class="z_tab_box">
            <section class="z_items content_inner" id="beauty_1"></section>
            <section class="z_items content_inner" id="beauty_2"></section>
            <section class="z_items content_inner" id="beauty_3"></section>
        </div>
    </div>
    <div style='height:1.2rem;'></div>
    <div class="fixed-btn">
        <?php if ($user): ?>
            <a href="javascript:$.util.checkLogin('/beauty/enroll');" class="f-bottom" >我的报名</a>
        <?php else: ?>
            <a href="javascript:$.util.checkLogin('/beauty/enroll');" class="f-bottom" >我要报名</a>
        <?php endif; ?>
    </div>
    <div class="zt_tips">
        <span class="zt_r_closed">&times;</span>
        <div class="zt_tips_box">
            <h3 class="color-items tc">规则说明</h3>
           <p class="jusitify"><strong>1.投票说明</strong><br />
•已注册并购帮的用户才能成为参赛选手； <br />
•用户需登录并购帮才能为心仪的选手投票；<br />
•一个用户每天只能对一个选手投一票，但可以投票给多个选手；<br />
•发现恶意刷票者，经劝阻无效的，将关闭其投票通道；<br />
•本次投票分为网络投票和专家评审团投票两个阶段，最终评选结果由主办方根据网络投票、专家投票综合决定。<br /></p>
<br />
<p class="jusitify"><strong>2.评选方式</strong><br />
•网络投票时间为10月08日-10月23日；<br />
•专家评审团投票时间10月25日-10月28日。
</p><br />
<p><strong>解释权归属主办方所有。</strong></p>
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
        <dd class="mt20"><span class="zt_num color-items fl">{#vote_nums#}票</span><span class="fr zt_r_btn {#vote_class#}" user_id="{#user_id#}">{#vote_word#}</span></dd>
    </dl>
</script>
<?php $this->start('script'); ?>
<script>
    window.shareConfig.link = 'http://m.chinamatop.com/beauty/index?share=1&ptag=10003';
    window.shareConfig.title = '2016并购菁英评选';
    var share_desc = '由并购帮主办的“2016并购菁英评选 ”10月8日启动';
    window.shareConfig.desc = share_desc;
    LEMON.show.shareIco();
</script>
<script type="text/javascript">
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/beauty/get-vote-user",
        success: function (res) {
            if (res.status) {
                var d = {};
                for(var i=0;i<res.data.length;i++){
                    var id = res.data[i].type_id;
                    if(!d[id]){
                        d[id] = [];
                    }
                    d[id].push(res.data[i]);
                }
                console.log(d);
                dealData(d[1], 1);
                dealData(d[2], 2);
                dealData(d[3], 3);
                tap($('.z_tab_head li').get(1));
            }
        }
    });
//    $.ajax({
//        type: 'POST',
//        dataType: 'json',
//        url: "/beauty/get-vote-user/2",
//        success: function (res) {
//            if (res.status) {
//                dealData(res.data, 2);
//                tap($('.z_tab_head li').get(1));
//            }
//        }
//    });
//    
//    
//    $.ajax({
//        type: 'POST',
//        dataType: 'json',
//        url: "/beauty/get-vote-user/3",
//        success: function (res) {
//            if (res.status) {
//                dealData(res.data, 3);
//            }
//        }
//    });
    
    
    
    function dealData(data, id) {
    if(!data)return;
        $.util.dataToTpl('beauty_'+id, 'tpl', data, function (d) {
            d.position = d.user.position;
            d.company = d.user.company;
            d.username = d.user.truename;
            d.user_id = d.user.id;
            d.pic = d.beauty_pics.length ? d.beauty_pics[0].pic_url : '';
            if (d.vote) {
                d.vote_class = 'bggray';
                d.vote_word = '已投票';
            } else {
                d.vote_class = 'vote';
                d.vote_word = '投 票';
            }
            return d;
        });
        $('.vote').on('tap', function () {
            var obj = $(this);
            if(!obj.hasClass('vote')){
                return false;
            }
            obj.removeClass('vote');
            $.util.ajax({
                url: '/beauty/vote/' + obj.attr('user_id'),
                func: function (res) {
                    if (res.status) {
                        obj.addClass('bggray').removeClass('vote');
                        obj.html('已投票');
                        obj.prev('span.zt_num').html(parseInt(obj.prev('span.zt_num').html()) + 1 + '票');
                    } else {
                        $.util.alert(res.msg);
                        obj.addClass('vote');
                    }
                }
            });
        });
    }


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


//    $('#enroll').on('tap', function () {
//        $.util.checkLogin('/beauty/enroll');
//    });
    
    $.util.searchHide();
</script>
<?php
$this->end('script');
