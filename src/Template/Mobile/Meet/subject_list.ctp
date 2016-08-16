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
    <section>
        <ul class="d-list">
            <?php if($subjects): ?>
                <?php foreach($subjects as $subject): ?>
                    <li>
                        <a class="alink clearfix" href="/meet/subject-detail/<?=$subject->id?>/#list">
                        <h3><?=$subject->title?></h3>
                        <span><?= $user->truename ?> <?= $user->company ?> <?= $user->position ?></span>
                        <i class="iconfont"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>暂无话题</li>
            <?php endif; ?>
        </ul>
    </section>
</div>
<!--<div class="submitbtn c-width">
    <a href="/meet/subject"><img src="/mobile/images/add-s.png"/></a>
</div>-->

<script>
    LEMON.sys.back('/user/home_page/<?= $user->id ?>');
</script>