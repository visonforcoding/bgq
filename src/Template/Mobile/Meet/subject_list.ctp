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
                        <?php if($subject->subject_book): ?>
                            <?php if($subject->subject_book->status == '0'): ?>
                                <h3><?=$subject->title?></h3>
                                <span><?= $user->truename ?> <?= $user->company ?> <?= $user->position ?></span>
                                <i>已约谈（未确认）</i>
                            <?php elseif($subject->subject_book->status == '1'): ?>
                                <a class="alink clearfix" href="/home/book-chat/<?=$subject->subject_books->id?>">
                                    <h3><?=$subject->title?></h3>
                                    <span><?= $user->truename ?> <?= $user->company ?> <?= $user->position ?></span>
                                    <i>已约谈（已确认）</i>
                                </a>
                            <?php else: ?>
                                <a class="alink clearfix" href="/meet/subject-detail/<?=$subject->id?>/#list">
                                    <h3><?=$subject->title?></h3>
                                    <span><?= $user->truename ?> <?= $user->company ?> <?= $user->position ?></span>
                                    <i class="iconfont">&#xe662</i>
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="alink clearfix" href="/meet/subject-detail/<?=$subject->id?>/#list">
                                <h3><?=$subject->title?></h3>
                                <span><?= $user->truename ?> <?= $user->company ?> <?= $user->position ?></span>
                                <i class="iconfont">&#xe662</i>
                            </a>
                        <?php endif; ?>
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
    LEMON.sys.back('/user/home-page/<?= $user->id ?>');
</script>