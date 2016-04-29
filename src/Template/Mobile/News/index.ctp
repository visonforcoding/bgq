<header>
    <div class='inner'>
        <h1>资讯</h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
    </div>
</header>
<div class="wraper newswraper">
    <div class="banner"></div>
    <?php if (isset($news)): ?>
        <?php foreach ($news as $news): ?>
            <section class='news-list-items '>
                <h1 class="firstnews"><span><img src="../images/user.png" /></span><?= $news->has('admin') ? $news->admin->truename : '' ?></h1>
                <a href="/mobile/news/view/<?= h($news->id) ?>" class="newsbox clearfix">
                    <div class="sec-news-l">
                        <h3><?= h($news->title) ?></h3>
                        <p><?= h($news->summary) ?></p>
                    </div>	
                    <div class="sec-news-r">
                        <img src="<?= h($news->cover) ?>"/>
                    </div>
                </a>
                <div class="news-bottom clearfix">
                    <div class="sec-b-l">
                        <div class="sec-like">
                            <span class="iconfont">&#xe616;</span><?= $this->Number->format($news->praise_nums) ?>
                        </div>
                        <div class="sec-comment">
                            <span class="iconfont">&#xe618;</span><?= $this->Number->format($news->comment_nums) ?>
                        </div>
                    </div>
                    <div class="sec-b-r">
                        <a href="#this">投资</a>
                        <a href="#this">资金</a>
                        <a href="#this">管理</a>
                    </div>
                </div>
            </section>	
        <?php endforeach; ?>
    <?php endif; ?>
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