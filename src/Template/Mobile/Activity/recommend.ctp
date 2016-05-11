		<header>
			<div class='inner'>
				<a href='#this' class='toback' id="toback"></a>
				<h1><?= $pagetitle; ?></h1>
				
			</div>
		</header>
		
		<div class="wraper">
			<div class="h20"></div>
			<h1 class='choose-org-type innerwaper a-choose'>推荐类型</h1>
			<div class="items">
				
			<div class="orgmark">
				<a href="#guest" class="agency-item" type="1">嘉宾推荐</a><a href="#place" class="agency-item" type="2">场地赞助</a><a href="#cash" class="agency-item" type="3">现金赞助</a><a href="#goods" class="agency-item" type="4">物品赞助</a><a href="#others" class="agency-item" type="5">其它</a>
			</div>
			</div>
			<div class="h20"></div>
			<input type="text" name="recommend_type" hidden />
			<div class="a-form-box" id="guest">
				<ul>
					<li>
						<span>姓名</span>
						<input type="text" name="name"/>
					</li>
					<li>
						<span>公司/机构</span>
						<input type="text" name="company"/>
					</li>
					<li>
						<span>部门</span>
						<input type="text" name="department" />
					</li>
					<li>
						<span>职务</span>
						<input type="text" name="job" />
					</li>
					<li>
						<i>经验简介</i>
						<textarea name="description"></textarea>
					</li>
				</ul>
			</div>
			<div class="a-form-box" id="place">
				<ul>
					<li>
						<span>地址</span>
						<input type="text" name="position" />
					</li>
					<li>
						<span>容纳人数</span>
						<input type="text" name="scale" />
					</li>
					
					<li>
						<i>其它说明</i>
						<textarea name="description"></textarea>
					</li>
				</ul>
			</div>
			<div class="a-form-box" id="goods">
				<ul>
					<li>
						<i>要求描述</i>
						<textarea name="description"></textarea>
					</li>
				</ul>
			</div>
			<div class="a-form-box" id="cash">
				<ul>
					<li>
						<i>要求描述</i>
						<textarea name="description"></textarea>
					</li>
				</ul>
			</div>
			<div class="a-form-box" id="others">
				<ul>
					<li>
						<i>要求描述</i>
						<textarea name="description"></textarea>
					</li>
				</ul>
			</div>
			<a href="#this" class='nextstep' id="submit">提交</a>
		</div>
		<?= $this->element('footer'); ?>
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
    $(function(){
       $('.agency-item').click(function(){
           $('.agency-item').removeClass('active');
           $(this).addClass('active');
           
           var attr = $(this).attr('href');
           $(attr).show().siblings('.a-form-box').hide();
           
           $(attr).siblings('.a-form-box').find('input').val(null);
           $(attr).siblings('.a-form-box').find('textarea').val(null);

           var val = $(this).attr('type');
           console.log(val);
           $('input[name="recommend_type"]').val(val);
       }) ;
    });

</script>
<?php $this->end('script');