<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            报名列表
        </h1>

    </div>
</header>

<div class="wraper">
    <div class="h20">

    </div>
    <section class="newscomment-box no-t-border">
        <?php if(!$recoms): ?>
                <div id="comment"><h4>暂无记录</h4></div>
        <?php endif;?>
          <?php foreach ($recoms as $recom):?>
        <div class="entrollist">
            <div class="comm-info etrol_con_des clearfix">
                <a href="/user/home-page/<?=$recom->user->id; ?>">
                    <span><img src="<?= $recom->user->avatar ? $recom->user->avatar : '/mobile/images/touxiang.png' ?>"/></span>
                    <div class="infor-comm">
                        <i class="username"><?=$recom->user->truename?> </i>
                        <i class="job j-width"><?=$recom->user->company?>   <?=$recom->user->position?></i>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach;?>
    </section>
</div>