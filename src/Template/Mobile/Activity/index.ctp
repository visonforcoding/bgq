
	<body>
		<header>
			<div class='inner'>
				<a href='/activity/release' class='subactivity' >发布活动</a>
				<h1><?= $pagetitle ?></h1>
				<a href="/activity/search" class='iconfont news-serch h-regiser'>&#xe613;</a>
			</div>
		</header>
		
		<div class="wraper newswraper a-wraper">
			<div class="a-banner">
		        <ul class="pic-list-container" id="imgList">
		        <?php foreach ($banners as $v): ?>
		        	<li><a href="<?= $v->url; ?>"><img src="<?= $v->img; ?>"/></a></li>
	        	<?php endforeach; ?>
		        </ul>
		        <div class="yd" id="imgTab">
		        <?php foreach ($banners as $v): ?>
		            <span class="cur"></span>
	            <?php endforeach; ?>
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
						<?php if ($isApply != ''): ?>
							<?php if(in_array($activity->id, $isApply)): ?>
								<span class="is-apply">已报名</span>
							<?php endif; ?>
						<?php endif; ?>
						</span>
						
						<div class="a-other-info">
							<span class="a-number"><?= $activity->apply_nums; ?>人报名</span>
							<?php foreach ($activity->industries as $k=>$v): ?>
							<a><?= $v->name; ?></a>
							<?php endforeach; ?>
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
<script src="/mobile/js/loopScroll.js"></script>
<script>
$(document).ready(function(){
	
});

var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'));

</script>
<?php $this->end('script');