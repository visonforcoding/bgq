<div class="wraper">
    <div class='h2'></div>
    <div class="invoic_moth_items">
        <div class="invoic_moth_con">
            <div class="innerwaper">
                <ul>
                    <?php foreach($order as $k=>$v): ?>
                    <li class="bd1" data-type='0'>
                        <div class="clearfix">
                            <div class="invoic_con_left fl">
                                <time><?= $v->lmorder->create_time->format('Y-m-d H:i') ?></time>
                                <p class="invoic_active"><span>活动：</span><?= $v->lmorder->activityapply->activity->title ?></p>
                            </div>
                            <div class="fr">
                                <span class="invoic_right_price"><i><?= $v->lmorder->fee ?></i>元</span>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>