
	<body>
		<header>
			<div class='inner'>
				<a href='/activity/release' class='toback subactivity' >发布活动</a>
				<h1><?= $pagetitle ?></h1>
				<a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
			</div>
		</header>
		
		<div class="wraper newswraper a-wraper">
			<div class="a-banner">
		        <ul class="pic-list-container" id="imgList">
		            <li><a href="#this"><img src="/mobile/images/a-banner.png"/></a></li>
		            <li><a href="#this"><img back_src="/mobile/images/banner.jpg"/></a></li>
		            <li><a href="#this"><img back_src="/mobile/images/a-banner.png"/></a></li>
		        </ul>
		        <div class="yd" id="imgTab">
		            <span class="cur"></span>
		            <span></span>
		            <span></span>
		        </div>
		    </div>
			<?php foreach ($activity as $activity): ?>
			<section class='news-list-items'>
				<div class="active-items">
					<a href="/activity/details/<?= $activity->id; ?>" class="a-head">
						<img src="<?= $activity->cover; ?>"/>
						<h3><?= $activity->title; ?></h3>
					</a>
					<div class="a-bottom">
						<span class="a-address">
						<?= $activity->address; ?>
						<?php if ($isApply): ?>
							<?php if(in_array($activity->id, $isApply)): ?>
								<span class="is-apply">已报名</span>
							<?php endif; ?>
						<?php endif; ?>
						</span>
						
						<div class="a-other-info">
							<span class="a-number"><?= $activity->apply_nums; ?>人报名</span>
							<a><?= $activity->industry->name; ?></a>
							<span class="a-date"><?= $activity->time; ?></span>
						</div>
						
					</div>
					
				</div>
			</section>
			<?php endforeach; ?>
			
		</div>
	</body>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script>
$('.subactivity').click(function(){
	location.href="";
})
$(document).ready(function(){
	
});

var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'));

</script>
<?php $this->end('script');