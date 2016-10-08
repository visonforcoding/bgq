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
    <div class="m_title_des bd1" >
        <h3>找会员</h3>
    </div>
    <div class="menusort clearfix">
        <div class="allmenu">
            <div class="menulist clearfix" id="allsort">
                <a href="/meet/search-by-agency/bgmj">
                    <i class="iconfont">&#xe69c;</i>
                    <span>并购买家</span>
                </a>
                <a href="/meet/search-by-agency/cytz">
                    <i class="iconfont">&#xe697;</i>
                    <span>产业投资</span>
                </a>
                <a href="/meet/search-by-agency/bgrz">
                   <i class="iconfont">&#xe696;</i>
                    <span>并购融资</span>
                </a>
                <a href="/meet/search-by-agency/bggw">
                   <i class="iconfont">&#xe695;</i>
                    <span>并购顾问</span>
                </a>
            </div>
        </div>
    </div>
    <!--分类--end-->
    <div class="dk">
        <div class="m_title_des bd1">
            <h3>为您推荐</h3>
        </div>
        <ul id='items'>
            <?php foreach ($biggieAd as $k => $v): ?>
                <li><a href="/user/home-page/<?= $v['savant']['user_id'] ?>"><img src="<?= $v['url'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="h2"></div>
    <div class="m_title_des bd1">
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
            <a href="/user/home-page/{#id#}"><span class="head-img"><img src="{#avatar#}"><i></i></span></a>
            <div class="vipinfo bd1">
                <div class="fl c_info_list">
                    <a href="/user/home-page/{#id#}">
                        <h3><div class="l-name">{#truename#}</div><div class="job line1">{#position#}</div></h3>
                        <span class="job">{#company#}</span>
                    </a>
                    <div class="mark line1">
                        {#subjects#}
                        <!--<a href="#this"><i class="iconfont"></i>演员的自我修养演员的自我修养演员的自我修养演员的自我修养</a>-->
                    </div>
                </div>
                <div class="m_focus_r r_focus_num fl {#focus_class#}" user_id="{#id#}" {#focus_id_str#}>
                    <span class="meetnum">{#meet_nums#}人聊过</span>
                    <i class="iconfont">&#xe614;</i>
                    <span class="msg">{#focus_msg#}</span>
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
    window.onBackView = function(){
        var user_follow = $.util.getCookie('user_follow');
        if(user_follow){
            setFollow(user_follow);
            $.util.setCookie('user_follow', '');
        }
    };
    window.onActiveView = window.onBackView;
    
    function setFollow(str){
        var tmp = str.split(',');
        for(var i=0; i< tmp.length;i++){
            if(!tmp[i]) continue;
            // 检查id前缀，添加取消不同处理
            if(tmp[i].indexOf('a') === 0){
                var id = tmp[i].replace('a', '');
                var obj = $('[user_id="'+id+'"]');
                obj.removeClass('color-items').addClass('notap').find('span.msg').html('已关注');
            }           
            else if(tmp[i].indexOf('d') === 0){
                var id = tmp[i].replace('d', '');
                var obj = $('[user_id="'+id+'"]');
                obj.addClass('color-items').removeClass('notap').find('span.msg').html('加关注');
                obj.attr('id', 'focus_'+id);
            }
        }
    }
    
    var page = 2;
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
        d.id = d.id ? d.id : '';
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
        //        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
        d.city = '';
        var subject = d.subjects.length ? d.subjects[0] : '';
        if (window.user_id == d.id) {
            d.subjects = subject ? '<a href="/meet/subject/' + subject.id + '"><i class="iconfont">&#xe67c;</i>' + subject.title + '</a>' : '';
        } else {
            d.subjects = subject ? '<a href="javascript:$.util.checkLogin(\'/meet/subject-detail/' + subject.id + '/#index\')"><i class="iconfont">&#xe67c;</i>' + subject.title + '</a>' : '';
        }
        d.focus_msg = d.followers.length ? '已关注' : '加关注';
        d.focus_class = d.followers.length ? '' : 'color-items';
        d.focus_id_str = d.followers.length ? '' : 'id="focus_'+ d.id +'"';
        return d;
    });

    
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
                                d.subjects = subject ? '<a href="/meet/subject/' + subject.id + '" class="line1 w7"><i class="iconfont">&#xe67c;</i>' + subject.title + '</a>' : '';
                            } else {
                                d.subjects = subject ? '<a href="javascript:$.util.checkLogin(\'/meet/subject-detail/' + subject.id + '/#index\')" class="line1 w7"><i class="iconfont">&#xe67c;</i>' + subject.title + '</a>' : '';
                            }
                            d.focus_msg = d.followers.length ? '已关注' : '加关注';
                            d.focus_class = d.followers.length ? '' : 'color-items';
                            d.focus_id_str = d.followers.length ? '' : 'id="focus_'+ d.id +'"';
                            return d;
                        });
                        $('#biggie').append(html);
                        if (res.data.length < 10) {
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

    
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if(em.id.indexOf('focus_') != -1){
            var obj = $(em);
            if (obj.hasClass('notap')) {
                return false;
            }
            obj.addClass('notap');
            var user_id = obj.attr('user_id');
            $.util.ajax({
                url: '/user/follow',
                data: {id: user_id},
                func: function (res) {
                    $.util.alert(res.msg);
                    if (res.status) {
                        if (res.msg.indexOf('取消关注') != '') {
                            obj.removeClass('color-items').find('span.msg').html('已关注');
                        } else {
                            obj.find('span.msg').html('加关注');
                            obj.removeClass('notap');
                        }
                    }
                }
            });
        }
    });

    (function () {
        if(!($.util.isAPP && $.util.isIOS)) return;
        if(LEMON.sys.version() == '1.03') return;
        var daa = (new Date()).getDate();
        if(daa == LEMON.db.get('daa')) return; //每天一次
        LEMON.db.set('daa', daa);

        if(window.confirm('尊敬的用户,您当前的APP版本存在部分页面无法加载的情况,请前往更新。')){
            LEMON.sys.update('https://itunes.apple.com/us/app/bing-gou-bang/id1156402644');
        }
        else {
            $.util.alert('如果您感到影响使用,可以前往appstore,搜索并购帮', 4000);
        }
    })();
</script>
<?php
$this->end('script');
