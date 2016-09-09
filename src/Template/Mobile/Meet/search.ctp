<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            搜索
           
        </h1>
       <!--  <a href="javascript:void(0);" class='h-regiser'>取消</a> -->
    </div>
</header>

<div class="wraper">
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe618;</a>
        <form id="searchForm">
            <h1><input type="text" name="keyword" placeholder="姓名、话题"></h1>
        </form>
        <div class='h-regiser' id="doSearch">搜 索</div>
    </div>
    <div id='biggie'></div>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info bbottom">
        <div class="innercon">
            <a href="/user/home-page/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/user/home-page/{#id#}">
                    <h3><div class="l-name">{#truename#}</div><span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark s_mark_h">
                    {#subjects#}
                </div>
            </div>
        </div>
    </section>
</script>
<script type="text/html" id='subTpl'>
    <a href="javascript:void(0)">{#title#}</a>
</script>
<?php $this->start('script'); ?>
<!--<script src='/mobile/js/meet_search.js'></script>-->
<script>
    $('input[name="keyword"]').focus();
    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page === 9999) {
                    $('#buttonLoading').html('亲，没有更多搜索结果了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.ajax({
                    type: 'post',
                    url: '/meet/getMoreSearch/' + page,
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
                                var html = $.util.dataToTpl('', 'biggie_tpl', msg.data , function (d) {
                                    d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                                    d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                                    d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                                    return d;
                                });
                                $('#biggie').append(html);
                                if(msg.data.length < 10){
                                    page = 9999;
                                } else {
                                    page++;
                                }
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
            });
        });
    }, 1000);
    
    $('#searchForm').on('submit', function(){
        if(!$('input[name="keyword"]').val)
        {
            $.util.alert('请输入搜索内容');
            return false;
        }
        $.ajax({
            type: 'post',
            url: '/meet/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    console.log(msg.data);
                    if (msg.status === true) {
                        $.util.dataToTpl('biggie', 'biggie_tpl', msg.data , function (d) {
                            d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                            d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                            return d;
                        });
                    } else {
                        $.util.hideLoading('buttonLoading');
                        $('#biggie').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        $('input[name="keyword"]').blur();
        return false;
    });
    
    $('#doSearch').on('tap', function(){
        if(!$('input[name="keyword"]').val) {
            $.util.alert('请输入搜索内容');
            return false;
        }
        $.ajax({
            type: 'post',
            url: '/meet/getSearchRes',
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    console.log(msg.data);
                    if (msg.status === true) {
                        $.util.dataToTpl('biggie', 'biggie_tpl', msg.data , function (d) {
                            d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                            d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                            return d;
                        });
                    } else {
                        $.util.hideLoading('buttonLoading');
                        $('#biggie').html('');
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        $('input[name="keyword"]').blur();
    });
</script>
<?php $this->end('script');