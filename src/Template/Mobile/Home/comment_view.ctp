<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>活动详情</h1>
    </div>
</header>
<div class="wraper pd10" style="display: block;">
    <section class="newscon-box a-detail">
        <h3><?= $table->title ?></h3>
        <!--add-->
        <h1 class="con-des origin"><!--<span><img src="../images/user.png" /></span>王璟--><div class="website">
                <?php if ($table->user): ?><?= $table->truename ?><?php else: ?><?= $table->source ?><?php endif; ?></div>
            <time><?= $table->create_time->i18nFormat('yyyy-MM-dd HH:mm') ?></time></h1>
    </section>
    <section class="newscomment-box no-t-border com_con_des">
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="<?= getAvatar($comment->user->avatar) ?>"/></span>
                <span class="infor-comm">
                    <i class="username"><?= $comment->user->truename ?><time><?= $comment->create_time->i18nFormat('yyyy-MM-dd HH:mm') ?></time></i>
                    <i class="job"><?= $comment->user->company ?> <?= $comment->user->position ?></i>
                </span>
                <span>
                    <i class="iconfont">&#xe61a;</i><?= $comment->praise_nums ?>
                </span>
            </div>
            <p><?= $comment->body ?></p>
        </div>
    </section>

    <?php if ($likes): ?>
        <section class="newscomment-box com_img_pic ">
            <div class="items  no-bottom">
                <a href="#this">
                    <div class="comm-info fl">
                        <?php foreach ($likes as $like):?>
                        <img src="<?=  getAvatar($like->user->avatar)?>"/>
                        <?php endforeach;?>
                    </div>
                    <span id="" class="fr total_number">
                        <em><?=$comment->praise_nums?></em>人赞过
                        <i class="iconfont">&#xe665;</i>	
                    </span>
                </a>
                <!--<span>显示全部</span>-->
            </div>
        </section>
    <?php endif; ?>
    <section class="newscomment-box comm_bottom_des">
        <h3 class="comment-title">
            回复我的评论
        </h3>
        <!--<div id="comment"><h4>还没任何评论</h4></div>-->
        <?php if ($replys): ?>
            <?php foreach ($replys as $item): ?>
                <div class="items">
                    <div class="comm-info clearfix">
                        <span><img src="<?= getAvatar($item->user->avatar) ?>"/></span>
                        <span class="infor-comm">
                            <i class="username"><?= $item->user->truename ?><time><?= $item->create_time->i18nFormat('yyyy-MM-dd HH:mm') ?></time></i>
                            <i class="job"><?= $item->user->company ?> <?= $item->user->position ?></i>
                        </span>
                        <span>
                            <i class="iconfont">&#xe61a;</i><?= $item->praise_nums ?>
                        </span>
                    </div>
                    <p class="a_bottom_comm"><?= $item->body ?></p>
                </div>    
            <?php endforeach; ?>
        <?php else: ?>
            <div id="comment"><h4>还没任何评论</h4></div>
        <?php endif; ?>
    </section>
</div>