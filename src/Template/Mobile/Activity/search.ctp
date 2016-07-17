<div class="fixedwraper" >
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe613;</a>
        <span class="sel-area"><span id="sellect">地区</span>
            <div class="arealist" hidden>
                <?php foreach($regions as $k=>$v): ?>
                <span class="regions" region_id="<?= $v['id'] ?>"><?= $v['name'] ?></span>
                <?php endforeach; ?>
            </div>
        </span>
        <form id="searchForm" >
        <h1><input type="text" name="keyword" placeholder="请输入关键词"></h1>
        <input type="hidden" name="series_id" value="" />
        <input type="hidden" name="region" value="" />
        </form>
        <div class='h-regiser' id="doSearch">搜索</div>
    </div>
    <div class='h2'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">活动系列</span>
        </div>
        <div class="orgmark">
            <?php foreach ($activitySeries as $k => $v): ?>
            <a href="javascript:void(0)" series_id="<?= $k ?>" class="series <?php if(is_numeric($sid)): ?><?php if($sid == $k):?>default<?php endif;?><?php endif;?>"><?= $v ?></a>
            <?php endforeach; ?>
        </div>
    </div>
<!--    <div class="news-classify">
        <div class="classify-l fl ml" id="choose_industry">
            <span id="choose_industries">选择分类</span>
            <ul class="all-industry" hidden id="choose_industry_ul">
                <?php foreach ($activitySeries as $k => $v): ?>
                <li id="parent_<?= $k ?>" series_id="<?= $k ?>" class="<?php if(is_numeric($sid)): ?><?php if($sid == $k):?>default<?php endif;?><?php endif;?>"><a href="javascript:void(0)"><?= $v ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="place-l fl ml" id="choose_region">
            <span id="choose_regions">选择地区</span>
            <ul class="sort-mark" id="choose_region_ul" hidden>
                <?php foreach($regions as $k=>$v): ?>
                <li id="region_<?= $v['id'] ?>" value='<?= $v['id'] ?>' class="choose_region_li"><a href="javascript:void(0);"><?= $v['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>-->
    <section class="my-collection-info" id="search"></section>
</div>
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
                <span>{#time#}<i>{#appply_nums#}人报名</i></span>
            </div>
        </a>
    </div>
</script>
<!--<script src="/mobile/js/activity_search.js"></script>-->
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $('input[name="keyword"]').focus();
    window.isApply = ',' + <?= $isApply ?> + ',';
    
    if($('.default').length != 0){
        seriesTap($('.default').get(0));
    }
    
    $('.orgname').on('tap',function(){
        if($('.orgmark').hasClass('ohide')){
            $('.orgmark').toggleClass('ohide');
            $('.orgmark').show();
        } else {
            $('.orgmark').toggleClass('ohide');
            $('.orgmark').hide();
        }
    })

    $('.sel-area').on('tap',function(){
        if($('.arealist').hasClass('hide')){
            $('.arealist').toggleClass('hide');
            $('.arealist').hide();
        } else {
            $('.arealist').toggleClass('hide');
            $('.arealist').show();
        }
    })
    
    $('.series').on('tap', function(){
        seriesTap(this);
    })
    
    function seriesTap(em){
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
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == - 1 ? '' : '<span class="is-apply">已报名</span>';
                            return d;
                        });
                        $('.orgmark').toggleClass('ohide');
                        $('.orgmark').hide();
                    } else {
                        $('#search').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }
    
    $('.regions').on('tap', function(){
        $('#sellect').text($(this).text());
        setTimeout(function(){
            $('.arealist').hide();
        },400);
        $('input[name="region"]').val($(this).attr('region_id'));
        $.ajax({
            type: 'post',
            url: '/activity/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == - 1 ? '' : '<span class="is-apply">已报名</span>';
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
    
    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            if($('.innercon').length == 0){
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
                                var html = $.util.dataToTpl('', 'search_tpl', msg.data , function (d) {
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
    
    
    $('#searchForm').submit(function(){
        $.ajax({
            type: 'post',
            url: '/activity/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == - 1 ? '' : '<span class="is-apply">已报名</span>';
                            return d;
                        });
                    } else {
                        $('#search').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
</script>
<?php
$this->end('script');
