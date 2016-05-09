<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            资讯内容
        </h1>
        <a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
</header>

<div class="wraper" id="news">
    <?php if (isset($news)): ?>
        <section class="newscon-box">
            <h3>{#title#}</h3>
            <img src="<?= $news->cover ?>"/>
            <p><?= strip_tags($news->body) ?></p>
            <div class="con-bottom clearfix">
                <span class="readnums">阅读<i><?= $this->Number->format($news->read_nums) ?></i></span>
                <span >
                    <i class="iconfont like">&#xe616;</i><?= $this->Number->format($news->praise_nums) ?>
                </span>
            </div>
        </section>
    <?php endif; ?>
    <section class="newscomment-box">
        <h3 class="comment-title">
            评论
            <i class="iconfont">&#xe618;</i>
            <span>我要点评</span>
        </h3>
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="/mobile/images/user.png"/></span>
                <span class="infor-comm">
                    <i class="username">Unclehome</i>
                    <i class="job">数字联盟有限公司 董事长</i>
                </span>
                <span>
                    <i class="iconfont">&#xe615;</i>398
                </span>
            </div>
            <p>非常值得一读的文章。</p>
        </div>
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="/mobile/images/user.png"/></span>
                <span class="infor-comm">
                    <i class="username">Unclehome</i>
                    <i class="job">数字联盟有限公司 董事长</i>
                </span>
                <span>
                    <i class="iconfont">&#xe615;</i>398
                </span>
            </div>
            <p>非常值得一读的文章。</p>
        </div>
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="/mobile/images/user.png"/></span>
                <span class="infor-comm">
                    <i class="username">Unclehome</i>
                    <i class="job">数字联盟有限公司 董事长</i>
                </span>
                <span>
                    <i class="iconfont">&#xe615;</i>398
                </span>
            </div>
            <p>非常值得一读的文章。</p>
        </div>
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="/mobile/images/user.png"/></span>
                <span class="infor-comm">
                    <i class="username">Unclehome</i>
                    <i class="job">数字联盟有限公司 董事长</i>
                </span>
                <span>
                    <i class="iconfont">&#xe615;</i>398
                </span>
            </div>
            <p>非常值得一读的文章。</p>
        </div>
    </section>
</div>
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
</script>
<?php $this->end('script');?>