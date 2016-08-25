<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>我的约见</h1>
        <!--<a href="javascript:void(0);" class="h-regiser h-add"></a>-->
    </div>
</header>
<div class="wraper">
    <div class="inner my-home-menu" >
        <a href="/home/my-book">我是顾客</a>
        <a href="javascript:void(0);"  class="active">我是会员</a>
    </div>
    <div class="inner my-home-slidemenu" >
        <a href="?type=1" <?php if ($type == 1): ?>class="active"<?php endif; ?>>待付款</a>
        <a href="?type=0"<?php if ($type == 0): ?>class="active"<?php endif; ?>>确认中</a>
        <a href="?type=3" <?php if ($type == 3): ?>class="active"<?php endif; ?>>已完成</a>
    </div>
    <?php foreach ($books as $book): ?>
        <a href="/home/my-book-savant-detail/<?= $book->id ?>">
            <section class="internet-v-info no-margin-top">
                <div class="innercon">
                    <span class="head-img"><img src="<?= empty($book->subject->user->avatar)?'/mobile/images/touxiang.jpg':$book->subject->user->avatar ?>"/><i></i></span>
                    <div class="vipinfo my-meet-info">
                        <h3><?= $book->user->truename ?><span class="meetnum">12人见过</span></h3>
                        <span class="job"><?= $book->user->company ?>&nbsp;&nbsp;<?= $book->user->position ?></span>
                        <div class="mark">
                            <a href="#this">约见话题：<?= $book->subject->title ?> </a>
                        </div>
                    </div>
                </div>
            </section>
        </a>
    <?php endforeach; ?>
</div>
<?php $this->start('script'); ?>
<script>
    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
</script>
<?php $this->end('script');