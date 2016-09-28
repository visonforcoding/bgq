<html style="background: #f0eff5;">
    <link rel="stylesheet" type="text/css" href="/mobile/css/zt.css"/>
    <script src="/mobile/js/view.js"></script>
    <div class="wraper content_inner">
        <div class="h2"></div>
        <div class="bg-ff">
            <div class="m_top_des clearfix">
                <div class="m_left-pic fl">
                    <img src="<?= $beauty->user->avatar ? $beauty->user->avatar : '/mobile/images/touxiang.png'; ?>"/>
                </div>
                <div class="m_center_des fl">
                    <h3 class="m_info_name"><?= $beauty->user->truename ?><span><i class="iconfont">&#xe660;</i><?= $beauty->user->city; ?></span></h3>
                    <span><?= $beauty->user->company ?> </span>
                    <span><?= $beauty->user->position ?> </span>
                </div>

            </div>
            <div class="m-listinfo-des infototal">
                <ul class="m-lilist-des">
                    <li>
                        <a>
                            <i><?= $beauty->beauty_id ?></i>
                            <span>编号</span>
                        </a>
                    </li>
                    <li>
                        <i><?= $beauty->vote_nums ?></i>
                        <span>票数</span>
                    </li>
                    <li>
                        <i><?= $rank ?></i>
                        <span>排名</span>
                    </li>
                </ul>
                <!--<div class="m-tomore-bottom">
                        <span><i class="iconfont">&#xe60b;</i>366人浏览过</span>
                        
                </div>-->
            </div>
        </div>
        <!--基本资料-->
        <div class="infotab m-infotab-list">
            <div class="tabcon bd2">
                <ul class="cur inner basicon">
                    <li class="b-hy"><span><i class="iconfont col_yellow">&#xe684;</i>我的星座</span><div><em><?= $beauty->constellation ?></em></div></li>
                    <li class="b-yw"><span><i class="iconfont col_cyan">&#xe670;</i>参赛宣言</span><div><em><?= $beauty->declaration ?></em></div></li>
                    <li class="b-gs"><span><i class="iconfont color-items">&#xe61c;</i>兴趣爱好</span><div><em><?= $beauty->hobby ?></em></div></li>
                    <li class="b-gs noafter"><span><i class="iconfont col_blue">&#xe67e;</i>个人简介</span>
                        <div>
                            <em>
                                <?= $beauty->brief ?>
                            </em>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--照片-->
        <?php if($beauty->beauty_pics): ?>
        <div class='photo_album mt20'>
            <div class="p_title  innercon"><h3><i class="iconfont">&#xe685;</i>Ta的照片</h3></div>
            <div class="photo_list bgff">
                <ul id='viewImg'>
                    <?php foreach ($beauty->beauty_pics as $k=>$v): ?>
                        <li><img src="<?= $v['pic_url'] ?>"/></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <!--基本资料-->
        <div class="infotab m-infotab-list">
        <ul class="h-tab">
            <li class="active"><i class="iconfont">&#xe650;</i>基本资料</li>
            <li><i class="iconfont">&#xe651;</i>工作经历</li>
            <li><i class="iconfont">&#xe652;</i>教育经历</li>
        </ul>
        <div class="tabcon bd2">
            <!--基本资料-->
            <?php if (!$self): ?>
                <ul class="cur inner basicon">
                    <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span>
                        <div>
                            <em><?= $beauty->user->city ? $beauty->user->city : '暂未填写' ?></em>
                        </div>
                    </li>
                    <li class="b-hy"><span><i class="iconfont">&#xe654;</i>所在行业</span>
                        <div>
                            <?php if ($beauty->user->industries): ?>
                                <?php foreach ($beauty->user->industries as $k => $v): ?>
                                    <em><?= $v['name'] ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-bq"><span><i class="iconfont">&#xe653;</i>个人标签</span>
                        <div>
                            <?php if (is_array(unserialize($beauty->user->grbq))): ?>
                                <?php foreach (unserialize($beauty->user->grbq) as $k => $v): ?>
                                    <em><?= $v ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-yw"><span><i class="iconfont">&#xe655;</i>擅长业务</span><div><em><?= $beauty->user->goodat ? $beauty->user->goodat : '暂未填写' ?></em></div></li>
                    <li class="b-gs nobottom"><span><i class="iconfont">&#xe656;</i>公司业务</span><div><em><?= $beauty->user->gsyw ? $beauty->user->gsyw : '暂未填写' ?></em></div></li>
                </ul>
            <?php else: ?>
                <ul class="cur inner basicon">
                    <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span>
                        <div>
                            <em><?= $beauty->user->city ? $beauty->user->city : '暂未填写' ?></em>
                        </div>
                    </li>
                    <li class="b-hy"><span><i class="iconfont">&#xe654;</i>所在行业</span>
                        <div>
                            <?php if ($beauty->user->industries): ?>
                                <?php foreach ($beauty->user->industries as $k => $v): ?>
                                    <em><?= $v['name'] ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-bq"><span><i class="iconfont">&#xe653;</i>个人标签</span>
                        <div>
                            <?php if (is_array(unserialize($beauty->user->grbq))): ?>
                                <?php foreach (unserialize($beauty->user->grbq) as $k => $v): ?>
                                    <em><?= $v ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-yw"><span><i class="iconfont">&#xe655;</i>擅长业务</span><div><em><?= $beauty->user->goodat ? $beauty->user->goodat : '暂未填写' ?></em></div></li>
                    <li class="b-gs noafter"><span><i class="iconfont">&#xe656;</i>公司业务</span><div><em><?= $beauty->user->gsyw ? $beauty->user->gsyw : '暂未填写' ?></em></div></li>
                </ul>
            <?php endif; ?>

            <!--工作经历-->
            <?php if (!$self): ?>
                <?php if ($beauty->user->secret): ?>
                    <?php if ($beauty->user->secret->career_set == '1'): ?>
                        <ul class="basicon worktab">
                            <?php if ($beauty->user->careers): ?>
                                <?php foreach ($beauty->user->careers as $career): ?>
                                    <li class="inner">
                                        <span>
                                            <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div><?= $career->company ?>
                                        </span>
                                    </li>
                                    <li class="inner bd1">
                                        <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                    </li>
                                    <li class="inner">
                                        <span class="worktime">
                                            <?= $career->descb; ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                                    </span>
                                </li>
                                <li class="inner">
                                    <span class="worktime">暂未填写</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="basicon worktab">
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未公开
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未公开</span>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <ul class="basicon worktab">
                        <?php if ($beauty->user->careers): ?>
                            <?php foreach ($beauty->user->careers as $career): ?>
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div><?= $career->company ?>
                                    </span>
                                </li>
                                <li class="inner bd1">
                                    <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                    <span class="worktime mt20">
                                        <?= $career->descb; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未填写</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            <?php else: ?>
                <ul class="basicon worktab">
                    <?php if ($beauty->user->careers): ?>
                        <?php foreach ($beauty->user->careers as $career): ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div><?= $career->company ?>
                                </span>
                            </li>
                            <li class="inner bd1">
                                <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                <span class="worktime mt20">
                                    <?= $career->descb; ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="inner">
                            <span>
                                <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                            </span>
                        </li>
                        <li class="inner">
                            <span class="worktime  ">暂未填写</span>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>

            <!--教育经历-->
            <?php if (!$self): ?>
                <?php if ($beauty->user->secret): ?>
                    <?php if ($beauty->user->secret->education_set == '1'): ?>
                        <ul class="basicon worktab">
                            <?php if ($beauty->user->educations): ?>
                                <?php foreach ($beauty->user->educations as $education): ?>
                                    <li class="inner">
                                        <span>
                                            <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                        </span>
                                    </li>
                                    <li class="inner">
                                        <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                                    </span>
                                </li>
                                <li class="inner">
                                    <span class="worktime">暂未填写</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="basicon worktab">
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未公开
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未公开</span>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <ul class="basicon worktab">
                        <?php if ($beauty->user->educations): ?>
                            <?php foreach ($beauty->user->educations as $education): ?>
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                    </span>
                                </li>
                                <li class="inner">
                                    <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未填写</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            <?php else: ?>
                <ul class="basicon worktab">
                    <?php if ($beauty->user->educations): ?>
                        <?php foreach ($beauty->user->educations as $education): ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="inner">
                            <span>
                                <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                            </span>
                        </li>
                        <li class="inner">
                            <span class="worktime">暂未填写</span>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
        <a href="/user/home-page/<?= $beauty->user->id ?>">
            <div class="photo_type innercon mt20"><h3>投票不尽兴？想约会员吗？请戳这里 <i class="iconfont">&#xe667;</i></h3></div>
        </a>
    </div>
    <div class="h2"></div>
    <div style="height:1rem"></div>
    <?php if($self): ?>
        <a href="/beauty/enroll" class="f-bottom">编辑资料</a>
    <?php else: ?>
        <a href="javascript:void(0);" class="f-bottom" id="vote" user_id="<?= $beauty->user->id ?>">投TA一票</a>
    <?php endif; ?>
<?php $this->start('script') ?>
    <script type="text/javascript">
        $('.h-tab>li').on('click', function () {
            var index = $(this).index() + 1;
            console.log($('.tabcon>ul').eq(index));
            $(this).addClass('active').siblings().removeClass('active');
            $('.tabcon>ul').eq(index).addClass('cur').siblings().removeClass('cur');
        });
        
        $('#commond').on('tap', function () {
            $(this).children('i').html('&#xe61b;');
        });
        
        $('#vote').on('tap', function(){
            var obj = $(this);
            $.util.ajax({
                url: '/beauty/vote/'+obj.attr('user_id'),
                func: function(res){
                    $.util.alert(res.msg);
                }
            });
        });
        
        $('#viewImg img').on('click', function(){
            var imgs = [];
            $('#viewImg img').each(function(){imgs.push(this.src.replace('small_', ''));});
            $.util.viewImg(this.src.replace('small_', ''), imgs);
        });
    </script>
<?php $this->end('script') ?>
</html>
