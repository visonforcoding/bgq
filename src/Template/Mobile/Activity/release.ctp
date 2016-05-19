		<header>
			<div class='inner'>
				<a href='#this' class='toback'></a>
				<h1><?= $pagetitle; ?></h1>
				
			</div>
		</header>
		
		<div class="wraper">
			<form action="" method="post">
				<div class="h20"></div>
				<div class="infoboxlist a-pay paytype">
					<ul class='ulinfo'>
						<li>是否为众筹项目：<span class='infocard'><input type="checkbox" name='pay' checked="true" /><i class='active'></i></span></li>
					</ul>
				</div>
				<div class="tojudge innercon tochoose">
					选择行业标签
					<span></span>
				</div>
				<div class="items">
					<div class="orgmark">
						<?php if($industries): ?>
						<?php foreach ($industries as $k=>$v): ?>
							<a href="#this" value="<?= $v['id']; ?>" class="industries"><?= $v['name']; ?></a>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="h20"></div>
				<div class="crowdfunding innercon">
					<span>题目</span><input type="text" name="title" />
					<span>内容</span><textarea name="body" rows="" cols=""></textarea>
				</div>
				<div class="h20"></div>
				
				<a href="#this" class='nextstep' id="submit">提交</a>
			</form>
		</div>
		<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script type="text/javascript">

	$('input[name="title"]').focus(function(){
		if($('.industries').length == 0)
		{
			$.util.alert('先选择行业标签');
			setTimeout(function(){location.href="/activity/industries"}, 3000);
			//location.href="/activity/industries";
		}
	})
	
	$('textarea[name="body"]').focus(function(){
		if($('.industries').length == 0)
		{
			$.util.alert('先选择行业标签');
			setTimeout(function(){location.href="/activity/industries"}, 3000);
			//location.href="/activity/industries";
		}
	})
	
	$('.tochoose').click(function(){
		location.href="/activity/industries";
	})
		
	$('input[name="pay"]').click(function(){
		$(this).siblings('i').toggleClass('active');
		if($(this).siblings('i').attr('class') == 'active')
		{
			$(this).attr('checked', true);
		}
		else
		{
			$(this).attr('checked', false);
		}
	})
	
	$('#submit').on('click', function () {
        var form = $('form');
        var formData = {};
        var agency = [];
        if($('input[name="title"]').val() == '')
        {
            $.util.alert('题目不能为空');
        }
        else if($('textarea[name="body"]').val() == '')
        {
            $.util.alert('请填写内容');
        }
        else if($('.industries').length = 0)
        {
            $.util.alert('请选择行业标签');
        }
        else
        {
            for(i=0;i<$('.industries').length;i++)
            {
            	agency.push($('.industries').eq(i).attr('value'));
            }
            formData.pay = $('input[name="pay"]').attr('checked');
            formData.title = $('input[name="title"]').val();
            formData.body = $('textarea[name="body"]').val();
            formData['industries[_ids]'] = agency;
        	$.ajax({
                type: 'post',
                url: form.attr('action'),
                data: formData,
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                        	$.util.alert(msg.msg);
                            setTimeout(function(){
                            	window.location.href = '/activity/index';
                            },3000);
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
        	});
        }
        return false;
    });
</script>
<?php $this->end('script');