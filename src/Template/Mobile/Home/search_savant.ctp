<div class="fixedwraper" >
    <div class='h-news-search'>
       <!--  <a href='javascript:void(0);' class='iconfont news-serch'>&#xe618;</a> -->
        <span class="sel-area"><span id="sellect">地区</span>
            <div class="arealist" hidden id="region">
                
            </div>
        </span>
        <form id="searchForm" >
        <h1><input type="text" name="keyword" placeholder="请输入关键词"></h1>
        <input type="hidden" name="industry_id" value="" />
        <input type="hidden" name="region" value="" />
        </form>
        <div class='h-regiser' id="doSearch">搜索</div>
    </div>
    <div class="markbox">
        <div class="a-s-title">
            <span class="orgname active">选择行业标签</span>
        </div>
        <ul class="a-s-mark s-width" id="industry">
        </ul>
    </div>
    <section id="search"></section>
    <div id="buttonLoading" class="loadingbox"></div>
</div>

<?php $this->start('script'); ?>
<script type="text/html" id="search_tpl">
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/meet/view/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/meet/view/{#id#}">
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
<script type="text/html" id="regionTpl">
    <span class="regions" region_id="{#id#}">{#name#}</span>
</script>
<script type='text/html' id='subTpl'>
    <a href="/meet/subject-detail/{#id#}">{#title#}</a>
</script>
<script type='text/html' id='mySubTpl'>
    <a href="/meet/subject/{#id#}">{#title#}</a>
</script>
<script type="text/html" id="industriesTpl">
    <li><a href="javascript:void(0)" industry_id="{#id#}" class="industry {#default#}">{#name#}</a></li>
</script>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    window.user_id = "<?= $user_id ?>";
</script>
<script>
    
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/home/get-region-and-industries",
        success: function (msg) {
            if(msg.status){
                $.util.dataToTpl('region', 'regionTpl', msg.region, function(d){
                    return d;
                });
                $.util.dataToTpl('industry', 'industriesTpl', msg.industries, function(d){
                    if(window.sid !== '.'){
                        if(d.id == window.sid){
                            d.default = 'default';
                        }
                    }
                    return d;
                });
                
                $.util.tap($('.industry'), function(e){
                    var target = e.srcElement || e.target;
                    industryTap(target);
                    return false;
                });
                
                $.util.tap($('.regions'), function(e){
                    var target = e.srcElement || e.target;
                    $('#sellect').text($(target).text());
                    setTimeout(function(){
                        $('.arealist').hide();
                    },400);
                    $('input[name="region"]').val($(target).text());
                    getRes();
                });
            }
        }
    });
    
    $('.a-s-title').on('touchstart',function(){
        $('.orgname').toggleClass('active');
        if($('.a-s-mark').hasClass('disp')){
            $('.a-s-mark').removeClass('disp').addClass('nblock');
        }else if($('.a-s-mark').hasClass('nblock')){
            $('.a-s-mark').removeClass('nblock').addClass('disp');
        }else{
            $('.a-s-mark').addClass('disp');
        }
    });
    
    $('.sel-area').on('tap',function(){
        if($('.arealist').hasClass('hide')){
            setTimeout(function(){
                $('.arealist').toggleClass('hide');
                $('.arealist').hide();
            },400);
        } else {
            $('.arealist').toggleClass('hide');
            $('.arealist').show();
        }
    });
    
    
    
    var search_data = {};
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
        } else if($('.a-s-mark').hasClass('nblock')) {
            $('.a-s-mark').removeClass('nblock').addClass('disp');
        } else {
            $('.a-s-mark').addClass('disp');
        }

        if(search_data[industry_id]){
            $('#search').html(search_data[industry_id]);
            return;
        }
        getRes();
    }
    
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
                    url: '/home/getMoreSearch/' + page,
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
                                var html = search_data[industry_id] = $.util.dataToTpl('', 'search_tpl', msg.data , function (d) {
                                    d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                                    d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                                    d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
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
        getRes();
        return false;
    });
    
    $('#doSearch').on('tap', function(){
        getRes();
    });
    
    function getRes(){
        $.ajax({
            type: 'post',
            url: '/home/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                            d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                            d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
//                            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                            if(window.user_id == d.id){
                                d.subjects = $.util.dataToTpl('', 'mySubTpl', d.subjects);
                            } else {
                                d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                            }
                            return d;
                        });
                    } else {
                        $('#search').html('');
                        $.util.hideLoading('buttonLoading');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }
</script>
<?php
$this->end('script');
