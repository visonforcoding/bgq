
	<body>
		<header>
			<div class='inner'>
				<a href='#this' class='toback subactivity'>发布活动</a>
				<h1>
					活动
					
				</h1>
				<a href="#this" class='iconfont news-serch h-regiser'>&#xe613;</a>
			</div>
		</header>
		
		<div class="wraper newswraper a-wraper">
			<div class="banner"></div>
			<?php foreach ($activity as $activity): ?>
			<section class='news-list-items'>
				<div class="active-items">
					<a href="details/<?= $activity->id; ?>" class="a-head">
						<img src="<?= $activity->cover; ?>"/>
						<h3><?= $activity->title; ?></h3>
					</a>
					<div class="a-bottom">
						<span class="a-address"><?= $activity->address; ?></span>
						<div class="a-other-info">
							<span class="a-number">601人报名</span>
							<a><?= $activity->industry->name; ?></a>
							<span class="a-date"><?= $activity->time; ?></span>
						</div>
					</div>
					
				</div>
			</section>
			<?php endforeach; ?>
			
		</div>
	<footer class="footer">
		<ul class="navfooter clearfix">
			<li class="active">
				<span class="iconfont">&#xe601;</span>
				<a href="#this">活动</a>
			</li>
			<li>
				<span class="iconfont">&#xe609;</span>
				<a href="#this">资讯</a>
			</li>
			<li>
				<span class="iconfont">&#xe60b;</span>
				<a href="#this">大咖</a>
			</li>
			<li>
				<span class="iconfont">&#xe60d;</span>
				<a href="#this">我</a>
			</li>
		</ul>
	</footer>
	</body>
	<div class="alert" id="alertPlan"></div>
<?php $this->start('script'); ?>
<script>
$('.toback').click(function(){
	history.back();
})
$(document).ready(function(){
	alert(123);
});
var winH = $(window).height();
var i = 1;
$(window).scroll(function () {
    var pageH = $(document.body).height(); //页面总高度 
    var scrollT = $(window).scrollTop(); //滚动条top 
    var aa = (pageH-winH-scrollT)/pageH;
//    if(aa<0.02){
//        $.getJSON("",{page:i},function(json){
//            if(json){
//                var str = "";
//                $.each(json,function(index,array){
//                    var str = "<div class=\"single_item\"><div class=\"element_head\">";
//                    str += "<div class=\"date\">"+array['date']+"</div>";
//                    str += "<div class=\"author\">"+array['author']+"</div>";
//                    str += "</div><div class=\"content\">"+array['content']+"</div></div>";
//                    $("#container").append(str);
//                });
//                i++;
//            }else{
//                alert("别滚动了，已经到底了。。。");
//                return false;
//            }
//        });
//    }
});

</script>
<?php $this->end('script');