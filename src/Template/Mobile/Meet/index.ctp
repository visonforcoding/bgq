 <div class="meet_search_box flex innercon">
        <form class="eleblock" id="searchForm">
            <div class="search-content">
                <i class="iconfont">&#xe602;</i>
                <input type="text" placeholder="搜索" name="keyword"/>
            </div>
        </form>
        <a href="/meet/chat-list">
            <div class="rico">
                <i class="iconfont">&#xe6ab;</i>
                <span id="un_read_msg"></span>
            </div>
        </a>
    </div>
<div class="wraper newswraper" id='wraper'>
   
    <div id="top_block"></div>
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
        </ul>
        <div class="yd" id="imgTab">
        </div>
    </div>
    <!--分类--start-->
    <!--<div class="h2"></div>-->
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
        </ul>
    </div>
    <div class="h2"></div>
    <div class="m_title_des bd1">
        <a class="title" href="/meet/all-elite">菁英推荐
            <span class="fr more">
                查看更多
                <i class="more iconfont rmore">&#xe667;</i>
            </span>
        </a>
    </div>
    <div id='elite'></div>
    <div class="h2"></div>
    <div class="m_title_des bd1">
        <h3>全部会员</h3>
    </div>
    <div id='biggie'></div>
    <div id="buttonLoading" class="loadingbox"></div>

</div>
<div class="submitbtn subactivity">
        <div class="back_to_top" id="toTop" onclick="javascript:window.scrollTo(0, 0);" style="display: none"><i class="iconfont">&#xe664;</i></div>
        <?php if (!$is_savant): ?>
            <div class="submit_require" id="auth"><a href="javascript:$.util.checkLogin('/home/savant-auth');">
                <span class="s-activ">会员<br>认证</span></a>
            </div>
        <?php else: ?>
            <div class="submit_require" id="auth"><a href="javascript:$.util.checkLogin('/meet/subject');">
                <span class="s-activ">发布<br>话题</span></a>
            </div>
        <?php endif; ?>
    </div>
<script id="itemsTpl" type="text/html">
    <li><a href="/user/home-page/{#user_id#}" class="meet-con"><img src="{#url#}"/></a></li>
</script>
<script type="text/html" id="bannerTpl">
    <li><a href="{#url#}"><img src="{#img#}"/></a></li>
</script>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/user/home-page/{#id#}"><span class="head-img"><img init_src="{#avatar#}"><i></i></span></a>
            <div class="vipinfo bd1">
                <div class="fl c_info_list">
                    <a href="/user/home-page/{#id#}">
                        <h3><div class="l-name">{#truename#}</div><div class="job line1">{#position#}</div></h3>
                        <span class="job">{#company#}</span>
                    </a>
                    <div class="mark line1">
                        {#subjects#}
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
    <a href="javascript:$.util.checkLogin('/meet/subject-detail/{#id#}/#index')" class="line1 w7"><i class="iconfont color-items">&#xe6aa;</i>{#title#}</a>
</script>
<script type='text/html' id='mySubTpl'>
    <a href="/meet/subject/{#id#}" class="line1 w7"><i class="iconfont color-items">&#xe6aa;</i>{#title#}</a>
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
        $('#top_block').css({'height': '68px'});
        $('.meet_search_box').css({'padding-top': '20px', 'height': '68px'});
    } else if ($.util.isWX) {
        $('#search').css({'top': '0.2rem'});
        $('#top_block').css({'height': '48px'});
        $('.meet_search_box').css({'padding-top': '0', 'height': '48px'});
    }
    if ($.util.isIOS) {
        $('#wraper').addClass('searchwraper');
    }
</script>
<script>
    var meet = function(o){
        this.opt = {
            no_cache: true,
            init_data: LEMON.db.get('biggie'), // 页面初始直接获取的数据
            init_elite: LEMON.db.get('elite'),
            init_banner: LEMON.db.get('banner'),
            init_biggieAd: LEMON.db.get('biggieAd')
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(meet.prototype, {
        init:function(){
            this.getBanner();
            this.getRecommend();
            this.getData();
            this.getUnReadMsg();
            this.getElite();
            this.search();
        },
        
        getBanner: function(){
            var obj = this;
            if(!obj.init_banner || obj.no_cache){
                $.getJSON('/meet/get-banner', function (res) {
                    if (res.status) {
                        obj.staticBanner(res.data);
                    }
//                    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));
                });
            } else {
                this.setHeader(JSON.parse(obj.init_banner));
            }
        },
        getRecommend: function(){
            var obj = this;
            if(!obj.init_biggieAd || obj.no_cache){
                $.getJSON('/meet/get-recommend', function (res) {
                    if (res.status) {
                        obj.staticRecommend(res.data);
                    }
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
                });
            } else {
                this.setRecommend(JSON.parse(obj.init_biggieAd));
            }
        },
        getElite: function(){
            var obj = this;
            if(!obj.init_elite || obj.no_cache){
                $.getJSON('/meet/get-elite/3', function (res) {
                    if (res.status) {
                        obj.staticElite(res.data);
                    }
                });
            } else {
                var html = $.util.dataToTpl('', 'biggie_tpl', JSON.parse(obj.init_elite), tpldate);
                $('#elite').append(html);
                $.util.initLoadImg('elite');
            }
        },
        getData: function(){
            var obj = this;
            if(!obj.init_data || obj.no_cache){
                $.getJSON('/meet/getMoreBiggie/1', function (res) {
                    if (res.status) {
                        obj.staticData(res.data);
                    }
                });
            } else {
                var html = $.util.dataToTpl('', 'biggie_tpl', JSON.parse(obj.init_data), tpldate);
                $('#biggie').append(html);
                $.util.initLoadImg('biggie');
            }
        },
        setHeader: function (data){
            var tab = [], html = $.util.dataToTpl('', 'bannerTpl', data, function (d) {
                tab.push('<span></span>');
                return d;
            });
            $('#imgList').html(html);
            $('#imgTab').html(tab.join(''));
            var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));
        },
        setRecommend: function (data){
            $.util.dataToTpl('items', 'itemsTpl', data, function(d){
                d.user_id = d.savant.user_id;
                return d;
            });
        },
        staticBanner: function (netBanner){
            var obj = this;
            var str = JSON.stringify(netBanner);
            if(str == obj.init_banner){
                this.setHeader(JSON.parse(obj.init_banner));
            } else {
                LEMON.db.set('banner', str);
                this.setHeader(JSON.parse(str));
            }
        },
        staticRecommend: function (netRecommend){
            var str = JSON.stringify(netRecommend);
            if(str == this.init_biggieAd){
                this.setRecommend(JSON.parse(this.init_biggieAd));
            } else {
                LEMON.db.set('biggieAd', str);
                this.setRecommend(JSON.parse(str));
            }
        },
        staticElite: function (netData){
            var str = JSON.stringify(netData);
            if(str == this.init_elite){
                $.util.dataToTpl('elite', 'biggie_tpl', JSON.parse(this.init_elite), tpldate);
            } else {
                LEMON.db.set('elite', str);
                $.util.dataToTpl('elite', 'biggie_tpl', JSON.parse(str), tpldate);
            }
            $.util.initLoadImg('elite');
        },
        staticData: function (netData){
            var str = JSON.stringify(netData);
            if(str == this.init_data){
                $.util.dataToTpl('biggie', 'biggie_tpl', JSON.parse(this.init_data), tpldate);
            } else {
                LEMON.db.set('biggie', str);
                $.util.dataToTpl('biggie', 'biggie_tpl', JSON.parse(str), tpldate);
            }
            $.util.initLoadImg('biggie');
        },
        getUnReadMsg: function (){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/meet/un-read-msg",
                success: function (res) {
                    if(res.data){
                        $('#un_read_msg').addClass('num').html(res.data);
                    } else {
                        $('#un_read_msg').removeClass('num').html('');
                    }
                }
            });
        },
        search: function(){
            $('#searchForm').on('submit', function(){
                if($('input[name="keyword"]').val() == ''){
                    return false;
                } else {
                    location.href = encodeURI('/meet/search/'+$('input[name="keyword"]').val());
                    return false;
                }
            });
        }
    });
    var meetobj = new meet();
    meetobj.init();
    
    window.onBackView = function () {
        var user_follow = $.util.getCookie('user_follow');
        if (user_follow) {
            setFollow(user_follow);
            $.util.setCookie('user_follow', '');
        }
        meetobj.getUnReadMsg();
    };
    window.onActiveView = window.onBackView;

    function setFollow(str) {
        var tmp = str.split(',');
        for (var i = 0; i < tmp.length; i++) {
            if (!tmp[i])
                continue;
            // 检查id前缀，添加取消不同处理
            if (tmp[i].indexOf('a') === 0) {
                var id = tmp[i].replace('a', '');
                var obj = $('[user_id="' + id + '"]');
                obj.removeClass('color-items').addClass('notap').find('span.msg').html('已关注');
            } else if (tmp[i].indexOf('d') === 0) {
                var id = tmp[i].replace('d', '');
                var obj = $('[user_id="' + id + '"]');
                obj.addClass('color-items').removeClass('notap').find('span.msg').html('加关注');
                obj.attr('id', 'focus_' + id);
            }
        }
    }

    function tpldate(d) {
        d.id = d.id ? d.id : '';
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
        //        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
        d.city = '';
        var subject = d.subjects.length ? d.subjects[0] : '';
        if (window.user_id == d.id) {
            d.subjects = subject ? '<a href="/meet/subject/' + subject.id + '"><i class="iconfont color-items">&#xe6aa;</i>' + subject.title + '</a>' : '';
        } else {
            d.subjects = subject ? '<a href="javascript:$.util.checkLogin(\'/meet/subject-detail/' + subject.id + '/#index\')"><i class="iconfont color-items">&#xe6aa;</i>' + subject.title + '</a>' : '';
        }
        d.focus_msg = d.followers ? '已关注' : '加关注';
        d.focus_class = d.followers ? '' : 'color-items';
        d.focus_id_str = d.followers ? '' : 'id="focus_' + d.id + '"';
        return d;
    }

    var page = 2;
    window.hideRelease = false;
    window.hideToTop = false;
    $(window).on("scroll", function () {
        // 滚动一个屏幕长度，隐藏发布活动
        var lastSt = window.hideRelease;
        window.hideRelease = document.body.scrollTop > $(window).height();
        var lastTo = window.hideToTop;
        window.hideToTop = document.body.scrollTop > '2000';
        if (lastSt != window.hideRelease) {
//            window.hideRelease ? $('#auth').removeClass('moveleft').addClass('moveright').css('display','none') : $('#auth').addClass('moveleft').css('display', 'grid');
            window.hideRelease ? $('#auth').hide() : $('#auth').show();
        }
        if(lastTo != window.hideToTop){
            window.hideToTop ? $('#toTop').show() : $('#toTop').hide();
        }
    });

    
//    $.util.initLoadImg('biggie');

    setTimeout(function () {
        var scrollObj;
        if ($.util.isIOS) {
            scrollObj = $('#wraper');
        } else {
            scrollObj = $(window);
        }
        scrollObj.on("scroll", function () {
            $.util.initLoadImg('biggie');
            $.util.listScroll('biggie', function () {
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
                        var html = $.util.dataToTpl('', 'biggie_tpl', res.data, tpldate);
                        $('#biggie').append(html);
//                        $.util.initLoadImg('biggie');
                        if (res.data.length < 100) {
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
//    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));

    // 会员推荐轮播
//    var sub = null;
//    setTimeout(function () {
//        sub = $.util.loop({
//            min: 3,
//            moveDom: $('#items'),
//            moveChild: $('#items li'),
//            lockScrY: true,
//            loopScroll: true,
//            autoTime: 0,
//            viewDom: $('.dk')
//        });
//    }, 0);

    $.util.searchHide();


    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('focus_') != -1) {
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

</script>
<?php
$this->end('script');
