<div class="wraper">
    <div class="train-intro-box bgff">
        <div class="train-intro">
            <img src="<?= $course->pic ?>" class="responseimg"/>
        </div>
        <div class="con">
            <h3 class="nav-title"><?= $course->title; ?></h3>
            <div class="flex flex_jusitify smallarea">
                <div class="price color-items"><?= $course->fee ? '￥'.$course->fee : '免费' ?></div>
                <div class="color-gray"><i><?= $course->read_nums ?></i>人预览</div>
            </div>
        </div>
    </div>
    <div class="train-intro-detail bgff mt20">
        <div class="title flex flex_jusitify  inner" id="down">
            <h3 class="color-items">课程简述</h3>
            <div class="iconfont r-ico">&#xe666;</div>
        </div>
        <div class="con inner" id="con">
            <p class='line2'><?= $course->abstract ?></p>
        </div>
    </div>
    <div class="course bgff mt20">
        <div class="title flex flex_jusitify">
            <h3 class="inner">课程目录（<?= $course->class_nums ?>）</h3>
        </div>
        <div class="courselist">
            <ul class="outerblock">
                <?php foreach ($course->classes as $k=>$v):?>
                <li class="items <?= $v->class_learn !== null ? 'read' : ''; ?>">
                    <a href="
                       <?php if($v->is_free): ?>
                            /class/detail/<?= $v->id; ?>
                            <?php else: ?>
                                <?php if($course->course_apply): ?>
                                /class/detail/<?= $v->id; ?>
                                <?php else: ?>
                                javascript:$.util.alert('您还没有购买此培训')
                                <?php endif; ?>
                            <?php endif; ?>
                       " class="eleblock">
                        <h3 class="course-title flex flex_jusitify">
                            <div class="eleblock left-info flex box_start">
                                <div>
                                    <?= $v->title ?>
                                    <?php if($v->is_free): ?>
                                        <i class="color-items" style="display: inline-block;padding:.02rem .1rem;border:1px #B71C2D solid;border-radius: 4px;">试听</i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="iconfont r-ico">&#xe667;</div>
                        </h3>
                        <div class="couser-pro flex" mentor_id="<?= $v->mentor->id ?>" id="mentor_<?= $v->mentor->id ?>">
                            <div class="avatar"><img src="<?= $v->mentor->avatar ?>" class="responseimg" /></div>
                            <div class="avatar-info">
                                <span><?= $v->mentor->name ?></span> | 
                                <span><?= $v->mentor->company ?></span> | 
                                <span><?= $v->mentor->position ?></span>
                            </div>
                        </div>
                    </a>
                </li>
<!--                <li class="items <?= $v->class_learn !== null ? 'read' : ''; ?>" >
                    <h3 class="course-title flex flex_jusitify">
                        <a href="
                            <?php if($v->is_free): ?>
                            /class/detail/<?= $v->id; ?>
                            <?php else: ?>
                                <?php if($course->course_apply): ?>
                                /class/detail/<?= $v->id; ?>
                                <?php else: ?>
                                javascript:$.util.alert('您还没有购买此培训')
                                <?php endif; ?>
                            <?php endif; ?>
                        " class="eleblock  box_start left-info flex"><i class="serial ">03</i><div><?= $v->title ?></div></a>
                        <div class="iconfont r-ico">&#xe667;</div>
                    </h3>
                    <div class="couser-pro flex" mentor_id="<?= $v->mentor->id ?>" id="mentor_<?= $v->mentor->id ?>">
                        <div class="avatar"><img src="<?= $v->mentor->avatar ?>" class="responseimg" /></div>
                        <div class="avatar-info">
                            <span><?= $v->mentor->name ?></span> | 
                            <span><?= $v->mentor->company ?></span> | 
                            <span><?= $v->mentor->position ?></span>
                        </div>
                    </div>
                </li>-->
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div style="height:1rem;"></div>
<?php if(!$course->course_apply): ?>
<a class="f-bottom" id="apply">我要报名</a>
<?php endif; ?>
<!--遮罩层-->
<div class="reg-shadow" style="display: none;" id="mentorData">
    
</div>
<div class="reg-shadow" style="display: none;" id="shadow">
</div>
<div class="charge-box charge-box-hide" id="buy">
    <div class="title">
        <h3 class="nav-title  inner"><?= $course->title ?></h3>
        <div class="iconfont closed" id="closed">&#xe6b4;</div>
    </div>
    <ul class="outerblock">
        <li>
            <div class="items flex flex_jusitify">
                <div class="left-info">支付总额：</div>
                <div class="color-items">￥<?= $course->fee ?></div>
            </div>
            <div class="items flex flex_jusitify">
                <div class="left-info">我的钱包：</div>
                <div class="color-items" id="my_wallet">--</div>
            </div>
        </li>
        <li id="need_charge">
            <div class="items flex flex_jusitify">
                <div class="left-info">还需充值：</div>
                <div class="color-items">--</div>
            </div>
        </li>
    </ul>
    <div class="inner mt60">
        <div class="btn-pay" id="buy_btn">
            立即充值
        </div>
    </div>
</div>
<script type="text/html" id="mentorTpl">
    <div class="flex flex_center fullwraper">
        <div class="alert-booking">
            <div class="tab-con-box tab-booking">
                <div class="booking-items">
                    <div class="nav-title flex">
                        <div class="avatar">
                            <img src='{#avatar#}' class="responseimg"/>
                        </div>
                        <div class="avatar-info">
                            <h3 class="user-name"><span>{#name#}</span></h3>
                            <div class="company-info">
                                <span>{#company#}</span> | 
                                <span>{#position#}</span>
                            </div>
                        </div>
                        <div class="btn-booking color-items" id="subscr_{#id#}" mentor_id="{#id#}">{#subscr_msg#}</div>
                    </div>
                    <div class="pro">
                        <p>{#introduce#}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<?php $this->start('script'); ?>
<script>
    // 分享设置
    window.shareConfig.link = 'http://m.chinamatop.com/course/detail/<?= $course->id ?>?share=1';
    window.shareConfig.title = '<?= $course->title ?>';
    var share_desc = '<?= str_replace(["\r\n", "\r", "\n"], '', $course->abstract) ?>';
    share_desc && (window.shareConfig.desc = share_desc);
    LEMON.show.shareIco();

    window.course_fee = '<?= $course->fee ?>';
    window.course_id = '<?= $course->id ?>';
</script>
<script type="text/javascript">
    var detail = function(o){
        this.opt = {
            course_id: ''
        };
        $.extend(this, this.opt, o);
    };
    $.extend(detail.prototype, {
        init: function(){
            this.buy();
            this.bodyTap();
        },
        
        buy: function(){
            var obj = this;
        },
        
        bodyTap: function(){
            var obj = this;
            $.util.tap($('body'), function(e){
                var target = e.srcElement || e.target, em = target, i = 1;
                while (em && !em.id && i <= 3) {
                    em = em.parentNode;
                    i++;
                }
                if (!em || !em.id)
                    return;
                if(em.id.indexOf('mentor_') != -1){
                    var tapObj = $(em);
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "/course/get-mentor-data/"+tapObj.attr('mentor_id'),
                        success: function (res) {
                            if(res.status){
                                $('#mentorData').html(obj.dealMentor(res.data)).show();
                            }
                        }
                    });
                    return false;
                }
                if(em.id.indexOf('subscr_') != -1){
                    if(!$.util.isLogin()){
                        $.util.alert('请先登录');
                        setTimeout(function(){location.href = '/user/login?redirect_url='+document.URL;}, 500);
                        return;
                    }
                    var tapObj = $(em);
                    $.util.ajax({
                        url: '/course/subscr-mentor/'+$(em).attr('mentor_id'),
                        func: function(res){
                            $.util.alert(res.msg);
                            if(res.data){
                                $('#subscr_'+tapObj.attr('mentor_id')).html('订阅');
                            } else {
                                $('#subscr_'+tapObj.attr('mentor_id')).html('取消订阅');
                            }
                        }
                    });
                }
                switch(em.id){
                    case 'mentorData': 
                        $('#mentorData').hide();
                        break;
                    case 'apply':
                        if(!$.util.isLogin()){
                            $.util.alert('请先登录');
                            setTimeout(function(){location.href = '/user/login?redirect_url='+document.URL;}, 500);
                            return;
                        }
                        $.util.ajax({
                            url: '/user/get-wallet',
                            func: function(res){
                                if(res.status){
                                    $('#my_wallet').html('￥'+res.data);
                                    if(res.data < window.course_fee){
                                        $('#need_charge').show();
                                        $('#need_charge').find('.color-items').html('￥'+(parseFloat(window.course_fee)-parseFloat(res.data)));
                                        $('#buy_btn').html('立即充值');
                                        window.is_money_enough = 0;
                                    } else {
                                        $('#need_charge').hide();
                                        $('#buy_btn').html('立即购买');
                                        window.is_money_enough = 1;
                                    }
                                    $('#shadow').show();
                                    $('#buy').toggleClass('charge-box-hide');
                                } else {
                                    $.util.alert(res.msg);
                                }
                            }
                        });
                        break;
                    case 'shadow': case 'closed':
                        $('#buy').toggleClass('charge-box-hide');
                        setTimeout(function(){$('#shadow').hide();}, 100);//和动画一致
                        break;
                    case 'buy_btn':
                        if(window.is_money_enough){
                            $.util.ajax({
                                url: '/wx/buy',
                                data: {course_id: window.course_id},
                                func: function(res){
                                    if(res.status){
                                        location.href = '/wx/buy-success/'+res.data;
                                    }
                                }
                            });
                        } else {
                            location.href = '/wx/charge';
                        }
                        break;
                    case 'down':
                        $('#con').find('p').toggleClass('line2');
                        $(em).find('.r-ico').toggleClass('rote');
                        break;
                }
                return false;
            });
        },
        
        dealMentor: function(data){
            var html = $.util.dataToTpl('', 'mentorTpl', data, function(d){
                if(d.mentor_subscribe){
                    d.subscr_msg = d.mentor_subscribe.is_del ? '订阅' : '取消订阅';
                } else {
                    d.subscr_msg = '订阅';
                }
                return d;
            });
            return html;
        }
    });
    var detailobj = new detail();
    detailobj.init();
</script>
<?php $this->end('script');