<div class="wraper">
    <div class='h-news-search'>
        <form id="searchForm" >
            <h1><input type="text" name="keyword" placeholder="请输入关键词"></h1>
            <input type="hidden" name="agency_id" value="" />
        </form>
        <div class='h-regiser' id="doSearch">搜索</div>
    </div>
    <div class="markbox">
        <div class="a-s-title">
            <span class="orgname active">选择标签</span>
        </div>
        <ul class="a-s-mark" id="agencies">
            <li><a href="javascript:void(0)" agency_id="0" class="agency active" id="agency_">全部</a></li>
        </ul>
    </div>
    <div id='biggies'></div>
</div>
<script type="text/html" id="agenciesTpl">
    <li><a href="javascript:void(0)" agency_id="{#id#}" class="agency" id="agency_{#id#}">{#name#}</a></li>
</script>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/user/home-page/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/user/home-page/{#id#}">
                    <h3><div class="l-name">{#truename#}</div>{#city#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark line2">
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
        url: "/meet/get-agency/<?= $id ?>",
        success: function (res) {
            if (res.status) {
                var html = $.util.dataToTpl('', 'agenciesTpl', res.data);
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
            $('.agency').removeClass('active');
            var agency_id = $(em).attr('agency_id');
            $(em).addClass('active');
            $('input[name="agency_id"]').attr('value', agency_id);
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
            case 'goTop':
                window.scrollTo(0, 0);
                e.preventDefault();
                break;
        }
    });

    function dealData(em) {
        var data = '';
        if ($(em).attr('agency_id') === '0') {
            data = $('#searchForm').serialize() + '&pid=<?= $id ?>';
        } else {
            data = $('#searchForm').serialize();
        }
        $.ajax({
            type: 'POST',
            url: '/meet/get-agencies-biggie',
            dataType: 'json',
            data: data,
            success: function (msg) {
                if (typeof msg == 'object') {
                    if (msg.status) {
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

</script>
<?php
$this->end('script');
