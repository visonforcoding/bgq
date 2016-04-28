$(function(){
	$('.items>.orgmark>a').toggle(function(){
		
		$(this).addClass('active');
	},
	function(){
		$(this).removeClass('active');
	})
	
	$('.orgname').toggle(function(){
		
		$(this).addClass('bgorgname');
		$(this).parents('.orgtitle').siblings().hide(200);
//		$(this).parent().nextSibling().hide();
	},
	function(){
		$(this).removeClass('bgorgname');
		$(this).parents('.orgtitle').siblings().show(200);
	})
})