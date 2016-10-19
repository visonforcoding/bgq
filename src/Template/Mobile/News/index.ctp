<header>
    <div class='inner'>
        <h1>资讯首页</h1>
    </div>
</header>
<div class="wraper newswraper">
    <div class="a_search_box" id="search" ptag="10000">
        <a href="/news/search"> 
            <i class="iconfont">&#xe618;</i>
        </a> 
    </div>
    <div class="a-banner">
        <ul class="pic-list-container" id="imgList"></ul>
        <div class="yd" id="imgTab"></div>
    </div>
    <div id="news"></div>
    <div id="buttonLoading" class="loadingbox"></div>
    <div class="submitbtn subactivity">
        <div class="back_to_top moveright" id="toTop" onclick="javascript:window.scrollTo(0, 0);"><i class="iconfont">&#xe664;</i></div>
    </div>
</div>

<script type="text/html" id="listTpl">
    <section class='news-list-items'>
<!--        <a href="javascript:void(0)">
            <h1 class="{#origin#}">{#author#}
                <time>{#publish_time#}</time>
            </h1>
        </a>-->
        <a href="/news/view/{#id#}" class="newsbox clearfix">
            <div class="sec-news-l">
                <h3>{#title#}</h3>
                <p>{#summary#}</p>
            </div>	
            <div class="sec-news-r">
                {#img#}
            </div>
        </a>
        <div class="news-bottom clearfix">
            <div class="sec-b-l">
                <div class="sec-like">
                    <span class="iconfont">&#xe61b;</span>{#praise_nums#}
                </div>
                <div class="sec-comment">
                    <span class="iconfont">&#xe61d;</span>{#comment_nums#}
                </div>
            </div>
            <div class="sec-b-r">
                {#newstags#}
            </div>
        </div>
    </section>
</script>
<script type="text/html" id="subTpl">
    <a href="/news/search/{#id#}">{#name#}</a>
</script>
<script type="text/html" id="bannerTpl">
    <li><a href="{#url#}"><img back_src="{#img#}"/></a></li>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    if($.util.isAPP){
        $('#search').css({'top':'0.6rem'});
    } else if($.util.isWX) {
        $('#search').css({'top':'0.2rem'});
    }
</script>
<script>
    window.hideToTop = false;
    $(window).on("scroll", function () {
        var lastTo = window.hideToTop;
        window.hideToTop = document.body.scrollTop > '2000';
        if(lastTo != window.hideToTop){
            window.hideToTop ? $('#toTop').addClass('moveleft') : $('#toTop').removeClass('moveleft').addClass('moveright');
        }
    });
    
    var page = 2;
    $.getJSON('/news/get-banner',function(res){
        if(res.status){
            var tab=[], html = $.util.dataToTpl('', 'bannerTpl', res.data, function (d) {
                tab.push('<span></span>');
                return d;
            });
            $('#imgList').html(html);
            $('#imgTab').html(tab.join(''));
            var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'),$('.a-banner'));
        }
    });
    
    function dealData(data){
        var html = $.util.dataToTpl('', 'listTpl', data, function (d) {
            if(d.source){
                d.author = '<div class="website">'+ d.source +'</div>';
                d.origin = 'origin';
            } else {
                if(d.user){
                    d.user_id = d.user.id;
                    d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                    d.author = '<span><img src="'+ d.avatar +'"/></span>' + d.user.truename;
                } else {
                    d.avatar = '/mobile/images/touxiang.png';
                    d.author = '<span><img src="'+ d.avatar +'"/></span><i style="color:red;">已封禁</i>';
                }
            }
            d.newstags = $.util.dataToTpl('', 'subTpl', d.newstags);
            d.cover = d.thumb ? d.thumb : d.cover;
            if(d.cover){
                d.img = '<img src="' + d.cover + '"/>';
            }
            return d;
        });
        return html;
    }
    
    $.getJSON('/news/get-more-news/1',function(res){
        if(res.status){
            $('#news').html('');
            var html = dealData(res.data);
            $('#news').append(html);
        }
    });

    
    setTimeout(function(){
    $(window).on("scroll", function () {
        $.util.listScroll('items', function () {
            if(page == 9999){
                $('#buttonLoading').html('亲，没有更多资讯了，请看看其他的栏目吧');
                return;
            }
            $.util.showLoading('buttonLoading');
            $.getJSON('/news/get-more-news/'+page,function(res){
                console.log('page~~~'+page);
                $.util.hideLoading('buttonLoading');
                window.holdLoad = false;  //打开加载锁  可以开始再次加载

                if(!res.status) {  //拉不到数据了  到底了
                    page = 9999;
                    return;
                }

                if(res.status){
                    var html = dealData(res.data);
                    $('#news').append(html);
                    if(res.data.length < 10){
                        page = 9999;
                        $('#buttonLoading').html('亲，没有更多资讯了，请看看其他的栏目吧');
                    } else {
                        page++;
                    }
                }
            });
        });
    });
    }, 2000);
    
    $.util.searchHide();
</script>
<?php $this->end('script'); ?>