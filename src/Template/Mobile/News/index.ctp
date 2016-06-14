<header>
    <div class='inner'>
        <h1>资讯</h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
    </div>
</header>
<div class="wraper newswraper">
    <div class="a-search-box">
        <div class="a-search">
            <a href="news-search.html"><i class="iconfont">&#xe613;</i></a>
            <div class="s-con">
                <input type="text" placeholder="请输入关键词" class="search"/>
            </div>
        </div>
    </div>
    <div class="a-banner">
        <ul class="pic-list-container" id="imgList">
            <?php foreach ($banners as $banner): ?>
                <li><a href="<?= $banner->url ?>"><img src="<?= $banner->img ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="yd" id="imgTab">
            <span class="cur"></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="news">

    </div>
    <div id="buttonLoading" class="loadingbox"></div>
</div>

<script type="text/html" id="listTpl">
    <section class='news-list-items '>
        <h1 class="firstnews"><span><img src="/mobile/images/user.png" /></span>{#admin_name#}</h1>
        <a href="/news/view/{#id#}" class="newsbox clearfix">
            <div class="sec-news-l">
                <h3>{#title#}</h3>
                <p>{#summary#}</p>
            </div>	
            <div class="sec-news-r">
                <img src="{#cover#}"/>
            </div>
        </a>
        <div class="news-bottom clearfix">
            <div class="sec-b-l">
                <div class="sec-like">
                    <span class="iconfont">&#xe616;</span>{#praise_nums#}
                </div>
                <div class="sec-comment">
                    <span class="iconfont">&#xe618;</span>{#comment_nums#}
                </div>
            </div>
            <div class="sec-b-r">
                {#industries_html#}
            </div>
        </div>
    </section>	
</script>
<script type="text/html" id="subTpl">
    <a href="#this">{#name#}</a>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('news', 'listTpl',<?= $newsjson ?>, function (d) {
        d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
        return d;
    });
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'));


    var page = 2;
    setTimeout(function(){
    $(window).on("scroll", function () {
        $.util.listScroll('items', function () {
            if(page == 9999){
                $('#buttonLoading').html('亲，没有更多资讯了，请明天再来吧');
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
                    var html = $.util.dataToTpl('', 'listTpl', res.data, function (d) {
                         d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
                         return d;
                    });
                    $('#news').append(html);
                    page++;
                }
            });
        });
    });
    }, 2000);
    
    $('.s-con').click(function () {
        $('.search').focus();
    });

    $('.search').focus(function () {
        location.href = "/news/search";
    });
    
    $.util.searchHide();
</script>
<?php $this->end('script'); ?>