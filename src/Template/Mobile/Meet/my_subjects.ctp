<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            话题列表
        </h1>
        <a href="#this" class='add-s h-regiser'></a>
    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <section>
        <ul class="m-detail-box sub-list">
            <?php foreach($subjects as $subject): ?>
                <li>
                    <a class="alink" href="/meet/subject/<?=$subject->id?>">
                    <div class="sub-list-l">
                        <h3><?=$subject->title?></h3>
                        <span>地点：<?=$subject->address ?></span>
                        <span>时间：<?=$subject->invite_time?></span>
                    </div>
                    <span class="meet-type">
                        <i>
                            <?php if($subject->type=='1'):?>
                                一对一面谈
                            <?php else:?>
                                一对多面谈
                            <?php endif;?>
                        </i>
                        <i><?=$subject->price?>元/次</i>
                        <i>约<?=$subject->last_time?>小时</i>
                    </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>
<div class="submitbtn c-width">
    <a href="release-activity.html"><img src="/mobile/images/add-s.png"/></a>
</div>