		<header>
			<div class='inner'>
				<a href='#this' class='toback' id="toback"></a>
				<h1>
					
					我要推荐
				</h1>
				
			</div>
		</header>
		
		<div class="wraper">
			<div class="h20"></div>
			<h1 class='choose-org-type innerwaper a-choose'>推荐类型</h1>
			<div class="items">
				
				<div class="orgmark">
					<a href="#this" class="agency-item">嘉宾推荐</a><a href="#this" class="agency-item">场地赞助</a><a href="#this" class="agency-item">现金赞助</a><a href="#this" class="agency-item">物品赞助</a><a href="#this" class="agency-item">其它</a>
				</div>
			</div>
			<div class="h20"></div>
			
			<div class="a-form-box">
				<ul>
					<li>
						<i>要求描述</i>
						<textarea name="description"></textarea>
					</li>
				</ul>
			</div>
			
			<a href="#this" class='nextstep' id="submit">提交</a>
		</div>
	<script src="/mobile/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>
<?php $this->start('script');?>
<script src="/mobile/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
<script>
		
	// 返回上一页
	$('#toback').click(function(){
		history.back();
	})
	
	// 分类单选
	var agency = 0;
    $(function(){
       $('.agency-item').click(function(){
           $('.agency-item').removeClass('active');
           $(this).addClass('active');
           agency = $(this).data('val');
       }) ;
    });
</script>
<?php $this->end('script');