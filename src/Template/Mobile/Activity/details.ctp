	<body>
		<header>
			<div class='inner'>
				<a href='#this' class='toback' id="toback"></a>
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
				<!-- 
				<p class="datetime">2016年04月27日</p>
				<div class="timenode">
					<p>
						<a>
							<span>13:00 - 14:00</span>
							<span>签到</span>
						</a>
						<a>
							<span>13:00 - 14:00</span>
							<span>活动开场</span>
						</a>
						<a>
							<span>14:00 - 14:05</span>
							<span>签到</span>
						</a>
						<a>
							<span>14:05 - 14:15</span>
							<span>天天投介绍</span>
						</a>
						<a>
							<span>14:15 - 14:55</span>
							<span>圆桌论坛+现场提问</span>
						</a>
						<a>
							<span>14:55 - 16:40</span>
							<span>12个项目路演</span>
						</a>
						<a>
							<span>14:40 - 18:00</span>
							<span>投融资面对面一对一交流</span>
						</a>
						<a>
							<span>18:00 - 00:00</span>
							<span>活动结束</span>
						</a>
						<div class="centerline">
							
						</div>
					</p>
					
				</div>
				 -->
			</section>
			<section class="a-detail newscomment-box guests">
				<h3 class="comment-title">参与嘉宾</h3>
				
				<p> 中银律师事务所合伙人 安寿辉</p>
				<p>中国文化产业基金总裁 陈 杭</p>
				<p>景林资本董事总经理 陈晓东</p>
				<p>奥美健康 董事长 褚 程</p>
				<p>光大体育基金总裁 范 南</p>
				<p>乐视体育CEO 雷振剑</p>
				<p>复星集团执行总经理 龚 林</p>
				<div class="con-bottom clearfix">
					<span class="readnums">阅读<i><?= $activity->read_nums; ?></i></span>
					
					<span >
						<i class="iconfont like">&#xe616;</i>
					</span>
					<span><i class='iconfont like h-regiser'>&#xe610;</i></span>
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
					<span>我要点评</span>
				</h3>
				<?php foreach ($comment as $k=>$v): ?>
				<div class="items">
					<div class="comm-info clearfix">
						<span><img src="<?= $v['user']['avatar'] ?>"/></span>
						<span class="infor-comm">
							<i class="username"><?= $v['user']['truename'] ?></i>
							<i class="job"><?= $v['user']['company'] ?> <?= $v['user']['position'] ?></i>
						</span>
						<span>
							<b class="addnum" id="addnum">+1</b><i class="iconfont" id="likecom">&#xe615;</i><?= $v['praise_nums'] ?>
						</span>
					</div>
					<p><?= $v['body'] ?></p>
				</div>
				<?php endforeach; ?>
				
			</section>
			<footer class="footer">
			<div class="a-btn">
				<a href="/activity/recommend/<?= $activity->id; ?>">我要推荐</a>
				<?php if ($isApply): ?>
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
		<!-- 
		<div class="reg-shadow">
			
		</div>
		<div class="shadow-info a-shadow a-forword">
			<ul style='display:none'>
				<li><textarea type="text" placeholder="请输入评论"></textarea></li>
				
				<li><a href="">取消</a><a href="">发表</a></li>
			</ul>
			<div>
			<h3>通过以下渠道转发</h3>
			<div class="forword">
				<a href="#this"><span></span>微信好友</a>
				<a href="#this"><span></span>微信朋友圈</a>
			</div>
			</div>
		</div>
		 -->
	</body>
<?php $this->start('script'); ?>
<script>
$('#toback').click(function(){
	history.back();
})
$(document).ready(function(){
	
});
$('#likecom').click(function(){
	$(this).siblings('b').addClass('show');
})
$('.addnum')[0].addEventListener("webkitAnimationEnd", function(){
    $('.show').removeClass('show');
});
$('.like').click(function(){
	$(this).toggleClass('changecolor');
})
</script>
<?php $this->end('script');