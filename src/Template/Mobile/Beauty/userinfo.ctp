<div class="wraper content_inner">
    <!--基本资料-->
    <div class="infotab m-infotab-list">
        <div class="tabcon bd2">
            <ul class="cur inner basicon">
                <li class="b-dq"><span><i class="iconfont">&#xe660;</i>姓 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span><div><em><?= $beauty->user->truename ?></em></div></li>
                <li class="b-hy"><span><i class="iconfont">&#xe654;</i>我的星座</span><div><em><?= $beauty->constellation ?></em></div></li>
                <li class="b-bq"><span><i class="iconfont">&#xe653;</i>个人标签</span>
                    <div>
                        <?php if($beauty->user->grbq): ?>
                            <?php foreach(unserialize($beauty->user->grbq) as $v): ?>
                                <em><?= $v; ?></em>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <em>暂未填写</em>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="b-yw"><span><i class="iconfont">&#xe655;</i>参赛宣言</span><div><em><?= $beauty->declaration ?></em></div></li>
                <li class="b-gs"><span><i class="iconfont">&#xe656;</i>兴趣爱好</span><div><em><?= $beauty->hobby ?></em></div></li>
                <li class="b-gs noafter"><span><i class="iconfont">&#xe656;</i>个人简介</span>
                    <div>
                        <em>
                            <?= $beauty->brief ?>
                        </em>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="h2"></div>
<div style="height:1rem"></div>
<a href="/beauty/index" class="nextstep">返回活动首页</a>
<script type="text/javascript">
    $('.h-tab>li').on('tap', function () {
        var index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.tabcon>ul').eq(index).addClass('cur').siblings().removeClass('cur');
    })
    $('#commond').on('tap', function () {
        $(this).children('i').html('&#xe61b;')
    })
</script>