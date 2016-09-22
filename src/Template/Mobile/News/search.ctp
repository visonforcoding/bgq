<?= $this->element('header'); ?>
<div class="fixedwraper">
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe618;</a>
        <form id="searchForm" >
            <h1><input type="text" placeholder="请输入关键词" name="keyword"></h1>
            <input type="hidden" name="newstag_id" value="" />
        </form>
        <div class='h-regiser' id="doSearch" >搜 索</div>
    </div>
    <div class="markbox">
        <div class="a-s-title">
            <span class="orgname active">选择标签</span>
        </div>
        <ul class="a-s-mark news_s_mark" id="industry">
            <li><a href="javascript:void(0)" industry_id='' class="industry ">全部</a></li>
        </ul>
    </div>
    <div id="search"></div>
</div>
<div id="buttonLoading" class="loadingbox"></div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script type="text/html" id="search_tpl">
    <section class="news-list-items" style="padding-bottom: 0.2rem;background: #fff;">
<!--        <h1><span><img src="{#avatar#}" /></span>{#author#}</h1>-->
        <a href="/news/view/{#id#}" class="newsbox clearfix">
            <div class="sec-news-l">
                <h3>{#title#}</h3>
                <p>{#summary#}</p>
            </div>
            <div class="sec-news-r">
                {#img#}
            </div>
        </a>
    </section>
</script>
<script type="text/html" id="industryTpl">
    <li>
        <a href="javascript:void(0)" industry_id='{#id#}' class="industry {#default#}">{#name#}</a>
    </li>
</script>
<!--<script src="/mobile/js/news_search.js"></script>-->
<script src="/mobile/js/loopScroll.js"></script>
<script>
    window.sid = '<?= $id ?>';
</script>
<script>
    var search_data = {};
    function industryTap(em) {
        if ($(em).hasClass('active')) {
            $(em).removeClass('active');
            $('input[name="newstag_id"]').val('');
            return;
        }
        $('.orgname').text($(em).text());
        $('#search').html('');
        $('.industry').removeClass('active');
        $(em).addClass('active');
        var industry_id = $(em).attr('industry_id');
        $('input[name="newstag_id"]').val(industry_id);
        

        LEMON.sys.hideKeyboard(); //收起键盘
        $.util.hideLoading('buttonLoading');
        if (search_data[industry_id]) {
            $('#search').html(search_data[industry_id]);
            $('.orgname').toggleClass('active');
            if ($('.a-s-mark').hasClass('a-s-width')) {
                $('.a-s-mark').removeClass('a-s-width');
            } else {
                $('.a-s-mark').addClass('a-s-width');
            }
            return;
        }
        $.ajax({
            type: 'post',
            url: '/news/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        search_data[industry_id] = $.util.dataToTpl('search', 'search_tpl', msg.data, function (d) {
                            d.cover = d.thumb ? d.thumb : d.cover;
                            if(d.cover){
                                d.img = '<img src="' + d.cover + '"/>';
                            }
                            return d;
                        });
                        $('.orgname').toggleClass('active');
                        if ($('.a-s-mark').hasClass('a-s-width')) {
                            $('.a-s-mark').removeClass('a-s-width');
                        } else {
                            $('.a-s-mark').addClass('a-s-width');
                        }
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/news/get-newstags",
        success: function (msg) {
            if (msg.status) {
                var html = $.util.dataToTpl('', 'industryTpl', msg.industries, function (d) {
                    if (window.sid) {
                        if (d.id == window.sid) {
                            d.default = 'default';
                        }
                    }
                    return d;
                });

                $('#industry').append(html);

                $.util.tap($('#industry'), function (e) {
                    var em = e.srcElement || e.target;
                    if (em.tagName == 'LI')
                        em = $(em).find('a').get(0);
                    if (em && em.tagName == 'A') {
                        industryTap(em);
                    }
                    return false;
                });
//                $('.industry').on('tap', function () {
//                    industryTap(this);
//                });
                if ($('.default').length != 0) {
                    industryTap($('.default').get(0));
                } else {
                    $('input[name="keyword"]').focus();
                    LEMON.sys.showKeyboard();
                }
            }
        }
    });

    $('.a-s-title').on('tap', function () {
        $('.orgname').toggleClass('active');
        if ($('.a-s-mark').hasClass('a-s-width')) {
            $('.a-s-mark').removeClass('a-s-width');
        } else {
            $('.a-s-mark').addClass('a-s-width');
        }
    });



    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            if ($('.news-list-items').length == 0) {
                return;
            }
            $.util.listScroll('items', function () {
                if (page === 9999) {
                    $('#buttonLoading').html('亲，没有更多资讯了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.ajax({
                    type: 'post',
                    url: '/news/getMoreSearch/' + page,
                    data: $('#searchForm').serialize(),
                    dataType: 'json',
                    success: function (msg) {
                        console.log('page~~~' + page);
                        $.util.hideLoading('buttonLoading');
                        window.holdLoad = false;  //打开加载锁  可以开始再次加载
                        if (!msg.status) {  //拉不到数据了  到底了
                            page = 9999;
                            return;
                        }
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                var html = $.util.dataToTpl('', 'search_tpl', msg.data, function (d) {
                                    d.cover = d.thumb ? d.thumb : d.cover;
                                    if(d.cover){
                                        d.img = '<img src="' + d.cover + '"/>';
                                    }
                                    return d;
                                });
                                $('#search').append(html);
                                page++;
                            }
                        }
                    }
                });
            });
        });
    }, 2000);

    $('#searchForm').submit(function () {
        search();
        return false;
    });

    $('#doSearch').on('tap', function () {
        search();
    });

    function search(){
        $.ajax({
            type: 'post',
            url: '/news/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data, function (d) {
                            d.cover = d.thumb ? d.thumb : d.cover;
                            if(d.cover){
                                d.img = '<img src="' + d.cover + '"/>';
                            }
                            return d;
                        });
                        $('.orgname').removeClass('active');
                        $('.a-s-mark').addClass('a-s-width');
                    } else {
                        $('#search').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        $('input[name="keyword"]').blur();
        LEMON.sys.hideKeyboard();
    }
</script>
<?php
$this->end('script');
