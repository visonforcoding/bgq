	<body>
		<header>
			<div class='inner'>
				<a href='#this' class='toback'></a>
				<h1><?= $pagetitle ?></h1>
				<!-- 
				<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a> // 收藏图标
				 -->
				<a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
			</div>
		</header>
		
		<div class="wraper" style="margin-bottom:2rem;">
			<section class="newscon-box a-detail">
				<h3><?= $activity->title; ?></h3>
				<img src="<?= $activity->cover; ?>"/>
				<p>主办单位：<?= $activity->company; ?></p>
				<p>时间：<?= $activity->time; ?></p>
				<p>地点：<?= $activity->address; ?></p>
				<p>规模：<?= $activity->scale; ?></p>
			</section>
			<section class="a-detail newscomment-box">
				<h3 class="comment-title">活动介绍</h3>
				<p class="p"><?= $activity->summary; ?>
</p>
				
			</section>
			<section class="a-detail newscomment-box">
				<h3  class="comment-title">活动流程</h3>
				<?= $activity->body; ?>
			</section>
			<section class="a-detail newscomment-box guests">
				<h3 class="comment-title">参与嘉宾</h3>
				<?= $activity->guest; ?>
				<div class="con-bottom clearfix">
					<span class="readnums"><i class="iconfont" style="font-size:0.3rem;">&#xe601;</i><?= $activity->read_nums; ?></span>
					
					<span >
						<i class="iconfont like<?php if ($isLike):?> changecolor<?php endif; ?>" artid="<?= $activity->id; ?>" type="0">&#xe616;</i>
					</span>
					<span><i class='iconfont collect h-regiser<?php if ($isCollect):?> changecolor<?php endif; ?>' artid="<?= $activity->id; ?>" type="0" >&#xe610;</i></span>
				</div>
			</section>
			<section class="newscomment-box joinnumber">
				<h3 class="comment-title">
					已报名
				</h3>
				<div class="items nobottom">
					<div class="comm-info clearfix">
					<?php if($userApply): ?>
					<?php foreach ($userApply as $k=>$v): ?>
						<a href='javascript:void(0);'><img src="<?= $v['avatar']; ?>"/></a>
					<?php endforeach; ?>
					<?php else : ?>
						暂时无人报名
					<?php endif; ?>
					</div>
					<!-- <span>显示全部</span> -->
				</div>
				
				
				
			</section>
			<section class="newscomment-box">
				<h3 class="comment-title">
					评论
					<i class="iconfont">&#xe618;</i>
					<span class="comment">我要点评</span>
				</h3>
				<?php foreach ($comment as $k=>$v): ?>
				<div class="items">
					<div class="comm-info clearfix">
						<span><img src="<?= $v['user']['avatar'] ?>"/></span>
						<span class="infor-comm">
							<i class="username"><?= $v['user']['truename'] ?> @回复人</i>
							<i class="job"><?= $v['user']['company'] ?> <?= $v['user']['position'] ?></i>
						</span>
						<span>
							<b class="addnum">+1</b><i class="iconfont" id="likecom" type="0" comid="<?= $v['id'] ?>">&#xe615;</i><b><?= $v['praise_nums'] ?></b>
						</span>
					</div>
					<p><?= $v['body'] ?></p>
				</div>
				<?php endforeach; ?>
				
			</section>
			<footer class="footer">
			<div class="a-btn">
				<a href="/activity/recommend/<?= $activity->id; ?>">我要推荐</a>
				<?php if ($isApply != ''): ?>
				<?php if(in_array($activity->id, $isApply)): ?>
				<a>已报名(<?= $activity->apply_fee; ?>元)</a>
				<?php else: ?>
				<a href="/activity/enroll/<?= $activity->id; ?>">我要报名(<?= $activity->apply_fee; ?>元)</a>
				<?php endif; ?>
				<?php else: ?>
				<a href="/activity/enroll/<?= $activity->id; ?>">我要报名(<?= $activity->apply_fee; ?>元)</a>
				<?php endif; ?>
			</div>
			</footer>
		</div>
		<div class="reg-shadow" ontouchmove="return false;" hidden>
			<div class="shadow-info a-shadow a-forword">
				<ul>
					<li><textarea type="text" placeholder="请输入评论" name="comment-content"></textarea></li>
					
					<li>
						<a href="javascript:void(0);" class="cancel">取消</a>
						<a href="javascript:void(0);" class="publish">发表</a>
					</li>
				</ul>
			</div>
		</div>
		
	</body>
<?php $this->start('script'); ?>
<script>

	$('.comment').click(function(){
		$('.reg-shadow').show();
		$('.shadow-info').show();
	})
	
	$('.cancel').click(function(){
		$('.reg-shadow').hide();
		$('.shadow-info').hide();
	});

	// 评论点赞
	$('#likecom').on('click', function(){
        $.ajax({
            type: 'post',
            url: '/activity/comLike/'+$(this).attr('comid'),
            data: 'type='+$(this).attr('type')+'&relate_id='+$(this).attr('comid'),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                    	var num = $('.addnum').siblings('b').text();
                		num = parseInt(num) + 1;
                        $('.addnum').siblings('b').text(num);
                        $('#likecom').siblings('.addnum').addClass('show');
                        // 动画结束前只能点击一次
                        var addnum = $('.addnum')[0];
                    	addnum.addEventListener("webkitAnimationEnd", function(){
                    	    $('.show').removeClass('show');
                    	});
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
	})
	

	// 喜欢按钮
	$('.like').click(function(){
		$.ajax({
            type: 'post',
            url: '/activity/artLike/'+$(this).attr('artid'),
            data: 'type='+$(this).attr('type')+'&relate_id='+$(this).attr('artid'),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        $('.like').toggleClass('changecolor');
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
	})
	
	// 收藏按钮
	$('.collect').click(function(){
		$.ajax({
            type: 'post',
            url: '/activity/collect/'+$(this).attr('artid'),
            data: 'type='+$(this).attr('type')+'&relate_id='+$(this).attr('artid'),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        $('.collect').toggleClass('changecolor');
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
	})
	
	
	// 我要点评
	$('.publish').click(function(){
		var data = {};
		data.body = $('textarea[name="comment-content"]').val();
		$.ajax({
            type: 'post',
            url: '/activity/doComment/<?= $activity->id ?>',
            data: data,
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                    	$.util.alert(msg.msg);
                    	setTimeout(function(){
                        	window.location.reload();
                        	window.doScroll('scrollbarDown');
                        }, 3000);
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
	})
</script>
<?php $this->end('script');