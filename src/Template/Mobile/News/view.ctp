<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            资讯内容
        </h1>
        <a href="#this" id="share" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
</header>

<div class="wraper" id="news">
    <?php if (isset($news)): ?>
        <section class="newscon-box">
            <h3><?= $news->title ?></h3>
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

            <span><i class="iconfont">&#xe618;</i>我要点评</span>
        </h3>
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="../images/user.png"/></span>
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
                <span><img src="../images/user.png"/></span>
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
                <span><img src="../images/user.png"/></span>
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
                <span><img src="../images/user.png"/></span>
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
    <div class="reg-shadow" style="display: none;">


    </div>
    <div class="shadow-info a-shadow a-forword" style="display: none;">
        <ul>
            <li><textarea type="text" placeholder="请输入评论"></textarea></li>

            <li><a href="javascript:void(0);">取消</a><a href="javascript:void(0);">发表</a></li>
        </ul>
    </div>
    <div class="alert">
        已收藏
    </div>
</div>
<?php $this->start('script') ?>
<script>
</script>
<?php $this->end('script'); ?>