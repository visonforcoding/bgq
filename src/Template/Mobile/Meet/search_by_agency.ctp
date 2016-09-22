<div class="wraper">
    <div class='h-news-search'>
        <form id="searchForm" >
            <h1><input type="text" name="keyword" placeholder="请输入关键词"></h1>
            <input type="hidden" name="agency_id" value="" />
            <input type="hidden" name="industry_id" value="" />
            <input type="hidden" name="type" value="<?= $type ?>" />
        </form>
        <div class='h-regiser' id="doSearch">搜索</div>
    </div>
    <div class="markbox" hidden>
        <div class="a-s-title">
            <span class="orgname active">选择标签</span>
        </div>
        <ul class="a-s-mark" id="agencies">
            <li><a href="javascript:void(0)" class="label active" id="all">全部</a></li>
        </ul>
    </div>
    <div id='biggies'></div>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type="text/html" id="tpl">
    {#label#}
</script>
<script type="text/html" id="agenciesTpl">
    <li><a href="javascript:void(0)" agency_id="{#id#}" class="label" id="agency_{#id#}">{#name#}</a></li>
</script>
<script type="text/html" id="industriesTpl">
    <li><a href="javascript:void(0)" industry_id="{#id#}" class="label" id="industry_{#id#}">{#name#}</a></li>
</script>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info bbottom">
        <div class="innercon">
            <a href="/user/home-page/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/user/home-page/{#id#}">
                    <h3><div class="l-name">{#truename#}<span class="job">&nbsp;&nbsp;{#position#}</span></div>{#city#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}</span>
                </a>
                <div class="mark s_mark_h line2">
                    {#subjects#}
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="/meet/subject-detail/{#id#}">{#title#}</a>
</script>
<script src="/mobile/js/loopScroll.js"></script>
<?php $this->start('script') ?>
<script type="text/javascript">
    window.sort = true;
    var tagscroll = new simpleScroll({
        moveDom: $('#industries_ul'),
        viewDom: $('#outer'),
        right: $('#toRight')
    });
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/meet/get-agency/<?= $type ?>",
        success: function (res) {
            if (res.status) {
                var html = '';
                if(res.data.agency){
                    html += $.util.dataToTpl('', 'agenciesTpl', res.data.agency);
                }
                if(res.data.industry){
                    html += $.util.dataToTpl('', 'industriesTpl', res.data.industry);
                }
                $('#agencies').append(html);
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

    $('#searchForm').on('submit', function () {
        if ($('input[name="keyword"]').val() == '') {
            $.util.alert('请填写内容再搜索');
            return false;
        }
        $('#biggies').html('');
        dealData();
        return false;
    });
//    console.log($('a[agency_id="0"]'));
    dealData($('a[agency_id="0"]').get(0));

    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('agency_') != -1) {
            $('.label').removeClass('active');
            var agency_id = $(em).attr('agency_id');
            $(em).addClass('active');
            $('input[name="agency_id"]').val(agency_id);
            $('input[name="industry_id"]').val('');
            $('#biggies').html('');
            dealData(em);
        }
        if (em.id.indexOf('industry_') != -1) {
            $('.label').removeClass('active');
            var industry_id = $(em).attr('industry_id');
            $(em).addClass('active');
            $('input[name="industry_id"]').val(industry_id);
            $('input[name="agency_id"]').val('');
            $('#biggies').html('');
            dealData(em);
        }
        switch (em.id) {
            case 'doSearch':
                if ($('input[name="keyword"]').val() == '') {
                    $.util.alert('请填写内容再搜索');
                    return false;
                }
                $('#biggies').html('');
                dealData();
                break;
            case 'all':
                $('.label').removeClass('active');
                var industry_id = $(em).attr('industry_id');
                $(em).addClass('active');
                $('input[name="industry_id"]').val(industry_id);
                $('input[name="agency_id"]').val('');
                $('#biggies').html('');
                dealData($('a[agency_id="0"]').get(0));
                break;
            case 'goTop':
                window.scrollTo(0, 0);
                e.preventDefault();
                break;
        }
    });

    function dealData(em) {
        var data = $('#searchForm').serialize();
        $.util.hideLoading('buttonLoading');
        $.ajax({
            type: 'POST',
            url: '/meet/get-agencies-biggie',
            dataType: 'json',
            data: data,
            success: function (msg) {
                if (typeof msg == 'object') {
                    if (msg.status) {
                        $('.orgname').toggleClass('active');
                        if ($('.a-s-mark').hasClass('a-s-width')) {
                            $('.a-s-mark').removeClass('a-s-width');
                        } else {
                            $('.a-s-mark').addClass('a-s-width');
                        }
                        $.util.dataToTpl('biggies', 'biggie_tpl', msg.data, function (d) {
                            d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
//                            d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                            d.city = '';
                            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                            return d;
                        });
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }

    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                console.log(page);
                if (page == 9999) {
                    $('#buttonLoading').html('亲，没有更多搜索结果了，请看看其他的栏目吧');
                    return;
                }
                $.util.showLoading('buttonLoading');
                data = $('#searchForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/meet/get-more-agencies-biggie/'+page,
                    dataType: 'json',
                    data: data,
                    success: function (msg) {
                        $.util.hideLoading('buttonLoading');
                        window.holdLoad = false;  //打开加载锁  可以开始再次加载

                        if (!msg.status) {  //拉不到数据了  到底了
                            page = 9999;
                            return;
                        }
                        if (typeof msg == 'object') {
                            if (msg.status) {
                                var html = $.util.dataToTpl('', 'biggie_tpl', msg.data, function (d) {
                                    d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
        //                            d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                                    d.city = '';
                                    d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                                    return d;
                                });
                                $('#biggies').append(html);
                                page++;
                            } else {
                                $.util.alert(msg.msg);
                                page = 9999;
                            }
                        }
                    }
                });
            });
        });
    }, 1000);
</script>
<?php
$this->end('script');
