	<body>
		<header>
			<div class='inner'>
				<a href='#this' class='toback' id="toback"></a>
				<h1><?= $pagetitle ?></h1>
				
			</div>
		</header>
		
		<div class="wraper">
			<div class="h20">
				
			</div>
			<form action="" method="post">
				<div class="infobox sing-up">
					<ul>
						<li>活动名称：<span class='infocard'><input type="text" name="title" value="<?= $activity->title; ?>" readonly/></span></li>
						<li>时间：<span class='infocard'><input type="text" name="time" value="<?= $activity->time; ?>" readonly/></span></li>
						<li>地点：<span class='infocard'><input type="text" name="address" value="<?= $activity->address; ?>" readonly/></span></li>
						<li>参与人：<span class='infocard'><input type="text" name="truename" value="<?= $user->truename; ?>" readonly/></span></li>
						<li>公司：<span class='infocard'><input type="email" name="company" value="<?= $user->company; ?>" readonly/></span></li>
						<li>职务：<span class='infocard'><input type="text" name="position" value="<?= $user->position; ?>" readonly/></span></li>
						<li>联系方式：<span class='infocard reg-pass'><input type="text" name="phone" value="<?= $user->phone; ?>" readonly/></span></li>
						<li>费用：<span class='infocard reg-repass'><input type="text" name="apply_fee" placeholder="<?= $activity->apply_fee; ?>元" readonly/></span></li>
					</ul>
				</div>
				<a href="#this" class="nextstep" id="submit">提交</a>
			</form>
		</div>
	
	</body>
<?php $this->start('script');?>
<script>
	// 返回上一页
	$('#toback').click(function(){
		history.back();
	})
	$(document).ready(function(){
		
	});
	$('#submit').on('click', function () {
        $form = $('form');
        $.ajax({
            type: 'post',
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                    	$.util.alert(msg.msg);
                        setTimeout(function(){
                        	window.location.href = '/activity/activity';
                        },3000);
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
</script>
<?php $this->end('script');