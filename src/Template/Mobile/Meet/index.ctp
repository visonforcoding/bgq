<header>
    <div class='inner'>
        <h1>
            专家约见
        </h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe618;</a>
    </div>
</header>

<div class="wraper newswraper">
    <div class="a-search-box" id="search">
        <a href="/meet/search">
            <div class="a-search">
                <i class="iconfont">&#xe618;</i>
                <div class="s-con">
                    <input type="text" placeholder="请输入关键词" readonly class='search'/>
                </div>
            </div>
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
        <h3>找专家</h3>
     </div>
    <div class="menusort clearfix">
        <div class="allmenu">
            <div class="menulist clearfix" id="allsort">
                <a href="/meet/search-by-agency/4">
                    <i class="iconfont col-g">&#xe66e;</i>
                    <span>并购买家</span>
                </a>
                <a href="/meet/search-by-agency/1">
                    <i class="iconfont col-o">&#xe637;</i>
                    <span>产业投资</span>
                </a>
                <a href="/meet/search-by-agency/2">
                    <i class="iconfont col-lg">&#xe66f;</i>
                    <span>并购融资</span>
                </a>
                <a href="/meet/search-by-agency/3">
                    <i class="iconfont col-y">&#xe621;</i>
                    <span>并购顾问</span>
                </a>
            </div>
        </div>
        <!-- <a href="javascript:void(0);" class="sele-r" id="toRight"></a> -->
    </div>
    <!--分类--end-->
    <div class="m_title_des">
        <h3>为您推荐</h3>
    </div>
    <div class="dk">
        <ul id='items'>
            <?php foreach ($biggieAd as $k => $v): ?>
                <li><a href="/user/home_page/<?= $v['savant']['user_id'] ?>"><img src="<?= $v['url'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="m_title_des">
        <h3>全部专家</h3>
    </div>
    <div class="h2"></div>
    <div id='biggie'></div>
    <div id="buttonLoading" class="loadingbox"></div>
    <div class="submitbtn">
        <a href="/home/savant_auth"><span class="s-activ">会员<br>认证</span></a>
    </div>
</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/user/home_page/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/user/home_page/{#id#}">
                    <h3><div class="l-name">{#truename#}</div>{#city#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark bgblue">
                    {#subjects#}
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="/meet/subject_detail/{#id#}/#index">{#title#}</a>
</script>
<script type='text/html' id='mySubTpl'>
    <a href="/meet/subject/{#id#}">{#title#}</a>
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
    $.util.dataToTpl('biggie', 'biggie_tpl',<?= $meetjson ?>, function (d) {
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
//        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
        d.city = '';
        if (window.user_id == d.id) {
            d.subjects = $.util.dataToTpl('', 'mySubTpl', d.subjects);
        } else {
            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
        }
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
                            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                            return d;
                        });
                        $('#biggie').append(html);
                        if (res.data.length < 5) {
                            page = 9999;
                        } else {
                            page++;
                        }
                    }
                });
            });
        });
    }, 2000);

    //轮播
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));
    //var loop2 = $.util.loopImg($('#items'), $('#imgList li'));


    // setTimeout(function(){
    //     var iconLoop = new simpleScroll({viewDom:$('#icons'),  moveDom:$('#allsort'), right:$('#toRight'), fix:25});
    // },1000);

    var sub = null;

    setTimeout(function () {
        sub = $.util.loop({
            min: 3,
            moveDom: $('#items'),
            moveChild: $('#items li'),
            lockScrY: true,
            loopScroll: true,
            autoTime: 0,
            viewDom: $('.dk'),
        });
    }, 0)

    $.util.searchHide();
</script>
<?php
$this->end('script');
