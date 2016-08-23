<div class="fixedwraper" >
    <div class='h-news-search'>
        <!--  <a href='javascript:void(0);' class='iconfont news-serch'>&#xe618;</a> -->
        <span class="sel-area"><span id="sellect">地区</span>
            <div class="arealist" hidden id="region">

            </div>
        </span>
        <form id="searchForm" >
            <h1><input type="text" name="keyword" placeholder="请输入关键词"></h1>
            <input type="hidden" name="series_id" value="" />
            <input type="hidden" name="region" value="" />
        </form>
        <div class='h-regiser' id="doSearch">搜索</div>
    </div>
    <div class="markbox">
        <div class="a-s-title">
            <span class="orgname active">活动系列</span>
        </div>
        <ul class="a-s-mark" id="series">

        </ul>
    </div>
    <section class="my-collection-info" id="search"></section>
</div>
<div style='height:1.2rem'></div>
<div id="buttonLoading" class="loadingbox"></div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script type="text/html" id="search_tpl">
    <div class="innercon">
        <a href="/activity/details/{#id#}" class="clearfix">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items">
                <h3>{#title#}</h3>
                {#apply_msg#}
                <span>{#address#}</span>
                <span>{#time#}<i>{#apply_nums#}人报名</i></span>
            </div>
        </a>
    </div>
</script>
<script type="text/html" id="regionTpl">
    <span class="regions" region_id="{#id#}">{#name#}</span>
</script>
<script type="text/html" id="seriesTpl">
    <li><a href="javascript:void(0)" series_id="{#id#}" class="series {#default#}">{#name#}</a></li>
</script>
<!--<script src="/mobile/js/activity_search.js"></script>-->
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var a = <?= $sid ?> + '.';
    if (a === '.') {
        window.sid = '';
    } else {
        window.sid = a;
    }
    $('input[name="series_id"]').val(<?= $sid ?>);
</script>
<script>

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/activity/get-region-and-series",
        success: function (msg) {
            if (msg.status) {
                $.util.dataToTpl('region', 'regionTpl', msg.region, function (d) {
                    return d;
                });
                $.util.dataToTpl('series', 'seriesTpl', msg.series, function (d) {
                    if (window.sid !== '.') {
                        if (d.id == window.sid) {
                            d.default = 'default';
                        }
                    }
                    return d;
                });

                $('.series').on('tap', function () {
                    seriesTap(this);
                });
                if ($('.default').length != 0) {
                    seriesTap($('.default').get(0));
                } else {
                    $('input[name="keyword"]').focus();
                    LEMON.sys.showKeyboard();
                }
                $('.regions').on('tap', function () {
                    $('#sellect').text($(this).text());
                    setTimeout(function () {
                        $('.arealist').hide();
                    }, 400);
                    $('input[name="region"]').val($(this).attr('region_id'));
                    $.ajax({
                        type: 'post',
                        url: '/activity/getSearchRes',
                        data: $('#searchForm').serialize(),
                        dataType: 'json',
                        success: function (msg) {
                            if (typeof msg === 'object') {
                                if (msg.status === true) {
                                    var html = $.util.dataToTpl('search', 'search_tpl', msg.data, function (d) {
                                        d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
                                        return d;
                                    });
                                } else {
                                    $('#search').html('');
                                    $.util.alert(msg.msg);
                                }
                            }
                        }
                    });
                });
            }
        }
    });


    window.isApply = ',' + <?= $isApply ?> + ',';



    $('.a-s-title').on('touchstart', function () {
        $('.orgname').toggleClass('active');
        if ($('.a-s-mark').hasClass('a-s-width')) {
            $('.a-s-mark').removeClass('a-s-width');
        } else {
            $('.a-s-mark').addClass('a-s-width');
        }
    });

    $('.sel-area').on('tap', function () {
        if ($('.arealist').hasClass('hide')) {
            setTimeout(function () {
                $('.arealist').toggleClass('hide');
                $('.arealist').hide();
            }, 400);
        } else {
            $('.arealist').toggleClass('hide');
            $('.arealist').show();
        }
    });



    function seriesTap(em) {
        $('.series').removeClass('active');
        $(em).addClass('active');
        $('input[name="series_id"]').val($(em).attr('series_id'));
        $('.orgname').text($(em).text());
        $.ajax({
            type: 'post',
            url: '/activity/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data, function (d) {
                            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
                            return d;
                        });
                        $('.orgname').toggleClass('active');
                        if ($('.a-s-mark').hasClass('a-s-width')) {
                            $('.a-s-mark').removeClass('a-s-width');
                        } else {
                            $('.a-s-mark').addClass('a-s-width');
                        }
                    } else {
                        $('#search').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }



    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            if ($('.innercon').length == 0) {
                return;
            }
            $.util.listScroll('items', function () {
                if (page === 9999) {
                    $('#buttonLoading').html('亲，没有更多条目了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.ajax({
                    type: 'post',
                    url: '/activity/getMoreSearch/' + page,
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
                                    d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
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

    function search() {
        $.ajax({
            type: 'post',
            url: '/activity/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data, function (d) {
                            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
                            return d;
                        });
                    } else {
                        $('#search').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        $('input[name="keyword"]').blur();
    }
    ;
</script>
<?php
$this->end('script');
