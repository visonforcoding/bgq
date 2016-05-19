		<header>
			<div class='inner'>
				<a href='#this' class='toback iconfont news-serch'>&#xe613;</a>
				<h1>
				<form action="" method="post">
					<input type="text" placeholder="请输入关键词" name="keyword" />
					<input type="hidden" name="industry_id" value="" style="display:none;"/>
					<input type="hidden" name="sort" value="" style="display:none;"/>
				</form>
				</h1>
				<a href="/activity/index" class='h-regiser'>取消</a>
			</div>
		</header>
		
		<div class="wraper" >
			
			<div class="news-classify">
				<div class="classify-l fl ml">
					<span class="l">选择行业</span>
					<ul class="all-industry" hidden>
					<?php foreach ($industries as $k=>$v): ?>
					<?php if($v['pid'] == 0): ?>
						<li class="parent"><a href="javascript:void(0)"><?= $v['name'] ?></a>
						<?php if ($v['child']): ?>
							<ul hidden>
							<?php foreach ($v['child'] as $key=>$val): ?>
								<li class="child" value="<?= $val['id'] ?>"><a href="javascript:void(0)"><?= $val['name'] ?></a></li>
							<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						</li>
					<?php endif; ?>
					<?php endforeach; ?>
					</ul>
				</div>
				
				<div class="classify-r fr">
					<span class="r">排序</span>
					<ul class="sort-mark" hidden>
						<li class="r-parent" value="apply_nums"><a href="javascript:void(0)">报名最多</a></li>
						<li class="r-parent" value="create_time"><a href="javascript:void(0)">最近更新</a></li>
					</ul>
				</div>
			</div>
			<?php if ($search): ?>
		<section class="my-collection-info" style="padding-bottom: 0.2rem;margin-bottom: 1rem;background: #fff;">
		<?php foreach ($search as $k=>$v): ?>
			<div class="innercon">
				<a href="#this" class="clearfix">
					<span class="my-pic-acive"><img src="<?= $v['cover'] ?>"/></span>
					<div class="my-collection-items">
						<h3><?= $v['title'] ?></h3>
						<?php if ($isApply): ?>
						<?php if (in_array($v['id'], $isApply)): ?>
						<span><i>已报名</i></span>
						<?php endif; ?>
						<?php endif; ?>
						<span><?= $v['address'] ?></span>
						<span><?= $v['time'] ?><i><?= $v['apply_nums'] ?>人报名</i></span>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
		</section>
		<?php endif; ?>
		</div>
		<div class="alert" id="alertPlan"></div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script type="text/javascript">
		
	$('.l').click(function(){
		$(this).toggleClass('active');
		if($(this).hasClass('active') == true)
		{
			$(this).siblings('ul').show();
			$(this).parent().siblings().children('span').removeClass('active');
			$(this).parent().siblings().children('ul').hide();
		}
		else
		{
			$(this).siblings('ul').hide();
		}
	})

	$('.r').click(function(){
		$(this).toggleClass('active');
		if($(this).hasClass('active') == true)
		{
			$(this).siblings('ul').show();
			$(this).parent().siblings().children('span').removeClass('active');
			$(this).parent().siblings().children('ul').hide();
		}
		else
		{
			$(this).siblings('ul').hide();
		}
	})
	
	$('.parent').click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
		$(this).children('ul').show();
		$(this).siblings().children('ul').hide();
	})
	
	$('.r-parent').click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
		$(this).children('ul').show();
		$(this).siblings().children('ul').hide();
		$("input[name='sort']").attr('value',$(this).attr('value'));
	})
	
	$('.child').click(function(){
		$(this).toggleClass('active');
		$(this).siblings().removeClass('active');
		$("input[name='industry_id']").attr('value',$(this).attr('value'));
	})
	
</script>
<?php $this->end('script');