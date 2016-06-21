<div class="m-wraper m-fixed-bottom wraper">
    <div class="h-home-bottom">
        <div><span><img src="<?= $user->avatar ?>"/></span><i class="iconfont">&#xe61e;</i></div>
        <h3><?= $user->truename ?><span><?= $user->company ?> <?= $user->position ?></span></h3>
        <h4>
            <a href="javascript:void(0);" class="tofocus-m fl">
                <span id="<?php if(!$isMe): ?>attention<?php endif; ?>">
                <?php if($type == 1): ?>
                已关注
                <?php elseif($type == 2):?>
                互相关注
                <?php else: ?>
                +关注
                <?php endif; ?>
                </span>
            </a>
            <a href="javascript:void(0);" class="tofocus-m fr">
                <span id="<?php if(!$isMe): ?>giveCard<?php endif; ?>">
                    <?php if($isGive): ?>
                    已递名片
                    <?php else: ?>
                    递名片
                    <?php endif; ?>
                </span>
            </a>
        </h4>

    </div>
    <ul class="h-info-box">
        <li>
            <h3>个人标签：<span>互联网资讯、企业并购、投融资管理</span></h3>
        </li>
        <li>
            <h3>公司业务：<span>互联网</span></h3>
        </li>
        
        <li>
            <p>教育经历：
                <?php if($user->education): ?>
                <?php foreach($user->education as $k=>$v): ?>
                <span><?= $v['school'] ?></span>
                <i><?= $v['start_date'] ?>-<?= $v['end_date'] ?>，<?= $v['education'] ?>，<?= $v['major'] ?></i>
                <?php endforeach; ?>
                <?php else: ?>
                <span>无。</span>
                <?php endif; ?>
            </p>
        </li>
        <li>
            <p>工作经历：
                <?php if($user->career): ?>
                <?php foreach($user->career as $k=>$v): ?>
                <span><?= $v['company'] ?></span>
                <i><?= $v['start_date'] ?>-<?= $v['end_date'] ?>，<?= $v['position'] ?></i>
                <?php endforeach; ?>
                <?php else: ?>
                <span>无。</span>
                <?php endif; ?>
            </p>
        </li>
        
        <li>
            <h3>联系电话：<span><?= $user->phone ?></span></h3>
        </li>
        <li>
            <h3>邮箱：<span><?= $user->email ?></span></h3>
        </li>
        <li>
            <h3>行业：<span>
                <?php if($user->ext_industry): ?><?= $user->ext_industry ?>、<?php endif; ?>
                <?php foreach($user->industries as $k=>$v): ?>
                    <?php if($k == 1): ?>、<?php endif; ?>
                    <?= $v['name'] ?>
                <?php endforeach; ?>
                </span>
            </h3>
        </li>
        <li class="no-b-border">
            <h3>所在地：<span><?= $user->city ?></span></h3>
        </li>



    </ul>

    <ul class="h-info-box">
        <li class="no-b-border">
            <a href="/meet/view/<?= $user->id ?>">专家主页</a>
        </li>
    </ul>
    <?php if($isMe): ?>
    <ul class="h-info-box">
        <li class="no-b-border">
            <a href="edit-user-info.html">编辑</a>
        </li>
    </ul>
    <?php endif; ?>
</div>
<?php $this->start('script'); ?>
<script>
    
    
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_')){
            console.log($(em));
        }
        switch(em.id){
            case 'imageViewer': case 'fullImg':
                //do();
            break;
            case 'attention':
                $.util.ajax({
                    url: '/meet/attention/<?= $user->id ?>',
                    dataType: 'json',
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            if(msg.status)
                            {
                                if(msg.type == 0)
                                {
                                    $('#attention').text('+关注');
                                }
                                else if(msg.type == 1)
                                {
                                    $('#attention').text('已关注');
                                }
                                else if(msg.type == 2)
                                {
                                    $('#attention').text('互相关注');
                                }
                                $.util.alert(msg.msg);
                            }
                            else
                            {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'giveCard':
                $.util.ajax({
                    url: '/meet/giveCard/<?= $user->id ?>',
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            $.util.alert(msg.msg);
                        }
                    }
                });
                break;
            case 'goTop':
                window.scrollTo(0,0);
                e.preventDefault();
                break;
        }
    });
    
    
</script>
<?php $this->end('script');