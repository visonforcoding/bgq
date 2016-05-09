<header>
    <div class='inner'>
        <h1>资讯</h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
    </div>
</header>
<div class="wraper newswraper">
    <div class="banner"></div>
    <div id="news"></div>
</div>
<script type="text/html" id="listTpl">
            <section class='news-list-items '>
                <h1 class="firstnews"><span><img src="../images/user.png" /></span>4444</h1>
                <a href="/mobile/news/view/{#id#}" class="newsbox clearfix">
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
                        <a href="#this">投资</a>
                        <a href="#this">资金</a>
                        <a href="#this">管理</a>
                    </div>
                </div>
            </section>	
</script>
<footer class="footer">
    <ul class="navfooter clearfix">
        <li>
            <span class="iconfont">&#xe601;</span>
            <a href="#this">活动</a>
        </li>
        <li>
            <span class="iconfont">&#xe609;</span>
            <a href="#this">资讯</a>
        </li>
        <li>
            <span class="iconfont">&#xe60b;</span>
            <a href="#this">大咖</a>
        </li>
        <li>
            <span class="iconfont">&#xe60d;</span>
            <a href="#this">我</a>
        </li>
    </ul>
</footer>
<?php $this->start('script') ?>
<script>
//        var data = <?php echo $newsjson; ?>,
//            tpl = $.util.id('listTpl').text,
//            html=[];
//        for(var i=0, len=data.length; i<len; i++){
//            html.push($.util.jsonToTpl(data[i], tpl));
//        }
//        $('#news').html(html.join(''));
$.util.dataToTpl('news','listTpl',<?=$newsjson?>);
</script>
<?php $this->end('script');?>