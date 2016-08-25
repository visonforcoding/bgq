<!--<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            话题列表
        </h1>
        <a href="#this" class='add-s h-regiser'></a>
    </div>
</header>-->
<div class="wraper">
    <div class="h2">
    </div>
    <?php if (empty($subjects)): ?>
    <div class="a-sj" style="display: block;">
        <span><img src="/mobile/images/subj.png"/></span>
        <p>很抱歉，你还未添加话题！</p>
        <a href="/meet/subject" class="nextstep">添加话题</a>
    </div>
    <?php endif; ?>
    <section>
        <ul class="d-list">
            <?php if ($subjects): ?>
                <?php foreach ($subjects as $subject): ?>
                    <li>
                        <a class="alink clearfix" href="/meet/subject/<?= $subject->id ?>">
                            <h3><?= $subject->title ?></h3>
                            <span><?= $user->truename ?> <?= $user->company ?> <?= $user->position ?></span>
                            <i class="iconfont"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </section>
</div>
<div class="submitbtn c-width">
    <a href="/meet/subject"><img src="/mobile/images/add-s.png"/></a>
</div>

<script>
    LEMON.sys.back('/user/home-page/<?= $user->id ?>');
</script>