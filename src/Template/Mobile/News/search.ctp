<?= $this->element('header'); ?>
<div class="fixedwraper">
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe613;</a>
        <form id="searchForm" >
        <h1><input type="text" placeholder="请输入关键词" name="keyword"></h1>
        <input type="hidden" name="industry_id" value="" />
        </form>
        <div class='h-regiser' id="doSearch" >搜 索</div>
    </div>
    <div class="markbox">
        <div class="a-s-title">
            <span class="orgname">选择行业标签</span>
        </div>
        <ul class="a-s-mark s-width">
            <?php foreach ($industries as $k => $v): ?>
                <?php if ($v['pid'] == 1): ?>
                <li>
                    <a href="javascript:void(0)" industry_id='<?= $v['id'] ?>' class="industry <?php if(is_numeric($id)): ?><?php if($id == $v['id']):?>default<?php endif;?><?php endif; ?>"><?= $v['name']?></a>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="search"></div>
</div>
<div id="buttonLoading" class="loadingbox"></div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script type="text/html" id="search_tpl">
    <section class="news-list-items" style="padding-bottom: 0.2rem;background: #fff;">
    <h1><span><img src="{#avatar#}" /></span>{#author#}</h1>
        <a href="/news/view/{#id#}" class="newsbox clearfix">
            <div class="sec-news-l">
                <h3>{#title#}</h3>
                <p>{#summary#}</p>
            </div>
            <div class="sec-news-r">
                <img src="{#cover#}"/>
            </div>
        </a>
    </section>
</script>
<script src="/mobile/js/news_search.js"></script>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $('.a-s-title .orgname').on('touchstart',function(){
        $(this).toggleClass('active');
        if($('.a-s-mark').hasClass('disp')){
            $('.a-s-mark').removeClass('disp').addClass('nblock');
        }else if($('.a-s-mark').hasClass('nblock')){
            $('.a-s-mark').removeClass('nblock').addClass('disp');
        }else{
            $('.a-s-mark').addClass('disp');
        }
    });
    

    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            if($('.news-list-items').length == 0){
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
                                var html = $.util.dataToTpl('', 'search_tpl', msg.data , function (d) {
                                    d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                    d.author = d.user.truename;
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
    
    var search_data = {};
    $('.industry').on('tap', function(){
        industryTap(this);
    });
    function industryTap(em){
        if($(em).hasClass('active')){
            $(em).removeClass('active');
            $('input[name="industry_id"]').val('');
            return;
        }
        $('.orgname').text($(em).text());
        $('#search').html('');
        $('.industry').removeClass('active');
        $(em).addClass('active');
        var industry_id = $(em).attr('industry_id');
        $('input[name="industry_id"]').val(industry_id);
        $('.orgname').toggleClass('active');
        if($('.a-s-mark').hasClass('disp')){
            $('.a-s-mark').removeClass('disp').addClass('nblock');
        }else if($('.a-s-mark').hasClass('nblock')){
            $('.a-s-mark').removeClass('nblock').addClass('disp');
        }else{
            $('.a-s-mark').addClass('disp');
        }

        if(search_data[industry_id]){
            $('#search').html(search_data[industry_id]);
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
                        search_data[industry_id] = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                            d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            d.author = d.user.truename;
                            return d;
                        });
                        
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }
    
    if($('.s-label li a.default').length != 0){
        industryTap($('.s-label li a.default').get(0));
    }
    else{
        setTimeout(function(){$('input[name="keyword"]').focus();}, 1000);
    }
    
    
    $('#searchForm').submit(function(){
        $.ajax({
            type: 'post',
            url: '/news/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                            d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            d.author = d.user.truename;
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
