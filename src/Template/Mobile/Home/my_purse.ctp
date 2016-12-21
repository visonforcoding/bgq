<!--<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            钱包
        </h1>
    </div>
</header>-->
<div class="wraper">
    <div class="my-purse-info">
        <a href='javascript:void(0);'></a>
        <p>¥<i><?= $userInfo->money ?></i></p>
        <!--<a href="/home/withdraw" class="nextstep">提现</a>-->
        <a href="/wx/charge" class="nextstep">充值</a>
    </div>
    <ul class='pay-detail' id="flows">
        <li><h3 class="color-items">钱包明细</h3></li>
        <?php foreach($flows as $flow): ?>
            <li>
                <div><span><?=$flow->remark?></span><i><?=$flow->create_time->i18nFormat('yyyy-MM-dd HH:mm')?></i></div>
                <span class="dollars">
                    <?php if($flow->is_gift): ?>
                    <!--TODO:赠送展示-->
                    <?php endif; ?>
                    <?php if($flow->user_id==$userInfo->id):?>+<?php else:?>-<?php endif;?><?=$flow->amount?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php $this->start('script') ?>
<?php $this->end('script')?>