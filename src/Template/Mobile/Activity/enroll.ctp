	<body>
		<header>
			<div class='inner'>
				<a href='#this' class='toback'></a>
				<h1>
					活动报名
				</h1>
				
			</div>
		</header>
		
		<div class="wraper">
			<div class="h20">
				
			</div>
			<div class="infobox sing-up">
				<ul>
					<li>活动名称：<span class='infocard'><input type="text" placeholder="<?= $activity->title; ?>" disabled style="background:white;"/></span></li>
					<li>时间：<span class='infocard'><input type="text" placeholder="<?= $activity->time; ?>" disabled style="background:white;"/></span></li>
					<li>地点：<span class='infocard'><input type="text" placeholder="<?= $activity->address; ?>" disabled style="background:white;"/></span></li>
					<li>参与人：<span class='infocard'><input type="text" placeholder="<?= $user->truename; ?>" disabled style="background:white;"/></span></li>
					<li>公司：<span class='infocard'><input type="email" placeholder="<?= $user->company; ?>" disabled style="background:white;"/></span></li>
					<li>职务：<span class='infocard'><input type="text" placeholder="<?= $user->position; ?>" disabled style="background:white;"/></li>
					<li>联系方式：<span class='infocard reg-pass'><input type="text" placeholder="<?= $user->phone; ?>" disabled style="background:white;"/></span></li>
					<li>费用：<span class='infocard reg-repass'><input type="text" placeholder="400元" disabled style="background:white;"/></span></li>
				</ul>
			</div>
			<a href="#this" class="nextstep">提交</a>
		</div>
	
	</body>
<?php $this->start('script');?>
<script>
	// 返回上一页
	$('.toback').click(function(){
		history.back();
	})
	
</script>
<?php $this->end('script');