<div class="wraper newswraper">
    <div class="a_search_box" id="search">
        <a href="/meet/search">
            <i class="iconfont">&#xe618;</i>
        </a>
    </div>
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
            <?php foreach ($banners as $k => $v): ?>
                <li><a href="<?= $v['url'] ?>"><img src="<?= $v['img'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="yd" id="imgTab">
            <?php foreach ($banners as $v): ?>
                <span></span>
            <?php endforeach; ?>
        </div>
    </div>
    <!--分类--start-->
    <div class="h2"></div>
    <div class="m_title_des" >
        <h3>找会员</h3>
    </div>
    <div class="menusort clearfix">
        <div class="allmenu">
            <div class="menulist clearfix" id="allsort">
                <a href="/meet/search-by-agency/4">
                    <i class="iconfont">&#xe66e;</i>
                    <span>并购买家</span>
                </a>
                <a href="/meet/search-by-agency/1">
                    <i class="iconfont">&#xe637;</i>
                    <span>产业投资</span>
                </a>
                <a href="/meet/search-by-agency/2">
                    <i class="iconfont">&#xe66f;</i>
                    <span>并购融资</span>
                </a>
                <a href="/meet/search-by-agency/3">
                    <i class="iconfont">&#xe621;</i>
                    <span>并购顾问</span>
                </a>
            </div>
        </div>
    </div>
    <!--分类--end-->
    <div class="dk">
        <div class="m_title_des">
            <h3>为您推荐</h3>
        </div>
        <ul id='items'>
            <?php foreach ($biggieAd as $k => $v): ?>
                <li><a href="/user/home-page/<?= $v['savant']['user_id'] ?>"><img src="<?= $v['url'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="h2"></div>
    <div class="m_title_des">
        <h3>全部会员</h3>
    </div>
    <div id='biggie'></div>
    <div id="buttonLoading" class="loadingbox"></div>
    <?php if (!$is_savant): ?>
        <div class="submitbtn" id="auth">
            <a href="javascript:$.util.checkLogin('/home/savant-auth');"><span class="s-activ">会员<br>认证</span></a>
        </div>
    <?php endif; ?>

</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/user/home-page/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo  bbottom fixedwraper">
                <a href="/user/home-page/{#id#}">
                    <h3><div class="l-name">{#truename#}</div>{#city#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job w7 line2">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark">
                    {#subjects#}
                   <!--<a href="#this" class="line1 w7"><i class="iconfont">&#xe67c;</i>演员的自我修养演员的自我修养</a>-->
                </div>

                <div class="m_focus_r color-items focus" user_id="{#id#}">
                    <i class="iconfont">&#xe614;<!--&#xe680;--></i>
                    <span>{#focus_msg#}</span>
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="javascript:$.util.checkLogin('/meet/subject-detail/{#id#}/#index')" class="line1 w7"><i class="iconfont">&#xe67c;</i>{#title#}</a>
</script>
<script type='text/html' id='mySubTpl'>
    <a href="/meet/subject/{#id#}" class="line1 w7"><i class="iconfont">&#xe67c;</i>{#title#}</a>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    window.user_id = "<?= $user_id ?>";
</script>
<script>
    if ($.util.isAPP) {
        $('#search').css({'top': '0.6rem'});
    } else if ($.util.isWX) {
        $('#search').css({'top': '0.2rem'});
    }
</script>
<script>

    window.hideRelease = false;
    $(window).on("scroll", function () {
        // 滚动一个屏幕长度，隐藏发布活动
        var lastSt = window.hideRelease;
        window.hideRelease = document.body.scrollTop > $(window).height();
        if (lastSt != window.hideRelease) {
            window.hideRelease ? $('#auth').removeClass('moveleft').addClass('moveright') : $('#auth').addClass('moveleft');
        }
    });

    $.util.dataToTpl('biggie', 'biggie_tpl',<?= $meetjson ?>, function (d) {
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
//        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
        d.city = '';
        var subject = d.subjects.length ? d.subjects[0] : '';
        if (window.user_id == d.id) {
//            d.subjects = $.util.dataToTpl('', 'mySubTpl', d.subjects);
            d.subjects = subject ? '<a href="/meet/subject/'+ subject.id +'" class="line1 w7"><i class="iconfont">&#xe67c;</i>'+ subject.title +'</a>' : '';
        } else {
//            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
            d.subjects = subject ? '<a href="javascript:$.util.checkLogin(\'/meet/subject-detail/'+ subject.id +'/#index\')" class="line1 w7"><i class="iconfont">&#xe67c;</i>'+ subject.title +'</a>' : '';
        }
        d.focus_msg = d.followers.length ? '取消关注' : '加关注';
        return d;
    });

    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page == 9999) {
                    $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.getJSON('/meet/getMoreBiggie/' + page, function (res) {
                    console.log('page~~~' + page);
                    $.util.hideLoading('buttonLoading');
                    window.holdLoad = false;  //打开加载锁  可以开始再次加载

                    if (!res.status) {  //拉不到数据了  到底了
                        page = 9999;
                        return;
                    }

                    if (res.status) {
                        var html = $.util.dataToTpl('', 'biggie_tpl', res.data, function (d) {
                            d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
//                            d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                            d.city = '';
                            var subject = d.subjects.length ? d.subjects[0] : '';
                            if (window.user_id == d.id) {
                    //            d.subjects = $.util.dataToTpl('', 'mySubTpl', d.subjects);
                                d.subjects = subject ? '<a href="/meet/subject/'+ subject.id +'" class="line1 w7"><i class="iconfont">&#xe67c;</i>'+ subject.title +'</a>' : '';
                            } else {
                    //            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                                d.subjects = subject ? '<a href="javascript:$.util.checkLogin(\'/meet/subject-detail/'+ subject.id +'/#index\')" class="line1 w7"><i class="iconfont">&#xe67c;</i>'+ subject.title +'</a>' : '';
                            }
                            d.focus_msg = d.followers.length ? '取消关注' : '加关注';
                            return d;
                        });
                        $('#biggie').append(html);
                        $('.focus').on('tap', function () {
                            var obj = $(this);
                            var user_id = obj.attr('user_id');
                            $.util.ajax({
                                url: '/user/follow',
                                data: {id: user_id},
                                func: function (res) {
                                    $.util.alert(res.msg);
                                    if (res.status) {
                                        if (res.msg.indexOf('取消关注') != '') {
                                            obj.find('span').html('取消关注');
                                        } else {
                                            obj.find('span').html('加关注');
                                        }
                                    }

                                }
                            });
                        });
                        if (res.data.length < 5) {
                            page = 9999;
                            $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                        } else {
                            page++;
                        }
                    }
                });
            });
        });
    }, 1000);

    //轮播
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));

    var sub = null;
    setTimeout(function () {
        sub = $.util.loop({
            min: 3,
            moveDom: $('#items'),
            moveChild: $('#items li'),
            lockScrY: true,
            loopScroll: true,
            autoTime: 0,
            viewDom: $('.dk')
        });
    }, 0);

    $.util.searchHide();

    $('.focus').on('tap', function () {
        var obj = $(this);
        var user_id = obj.attr('user_id');
        $.util.ajax({
            url: '/user/follow',
            data: {id: user_id},
            func: function (res) {
                $.util.alert(res.msg);
                if (res.status) {
                    if (res.msg.indexOf('取消关注') != '') {
                        obj.find('span').html('取消关注');
                    } else {
                        obj.find('span').html('加关注');
                    }
                }

            }
        });
    });
</script>
<?php
$this->end('script');
