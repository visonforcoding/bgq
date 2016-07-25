<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            话题
        </h1>
        <!-- <a href="#this" class='iconfont share h-regiser'>&#xe614;</a> -->
    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <section>
        <ul class="m-detail-box">
            <li>
                <h3><?=$subject->title?> <span><?=$subject->truename?> <?=$subject->company?> <?=$subject->position?></span></h3>
                <span class="meet-type">
                    <?php if($subject->type==1):?>
                    一对一面谈
                    <?php else:?>
                    一对多面谈
                    <?php endif;?>
                </span>
            </li>
            <li>
                <span><?=$subject->price?>元/次</span>
                <span>约<?=$subject->last_time?>小时</span>
            </li>
            <li>
                <p>
                    <?=$subject->summary?>
                </p>
            </li>
            <li>
                <div>
                    <span>地点:<?=$subject->address?></span>
                    <span>时间：<?=$subject->invite_time?></span>
            </li>
            </div>
        </ul>
    </section>
    <?php if($book->status==1):?>
    <a href="/wx/meet-pay/1/<?=$book->lmorder->id?>" class="nextstep">去付款</a>
    <?php endif;?>
    <?php if($book->status==0):?>
        <a href="#this" class="nextstep">取消预约</a>
    <?php endif;?>
</div>