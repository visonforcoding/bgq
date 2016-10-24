	$(function(){
		//登录
		checkLogin();
	});
	//登录
	function checkLogin(){
			var submit = $('#loginbtn');
			$('#loginbtn').on('tap',function(){
				var user = $('#username').val();
				var channer =$('#valid').val(); 
				var jsoninfo = {};
				if(user == ''){
					alert('请输入手机号！');
				}
				$.ajax({
					type:'get',
					url:'http://182.48.107.222:8080/IntegralStore/user/login?channelId=toprays&userName=luozheng&inviterAccount=xxx',
					dataType:'jsonp',
					success:function(result){
						console.log(result);
	//					jsoninfo.nickName = data.nickName
						savaStorge();
					}
				});
			});
			
	}
	//存储
	function creatStorge(){
		var obj = window.localStorage;
		return obj;
	}

	function savaStorge(jsons){
		var _obj = creatStorge();
		for(var key in jsons){
			_obj.setItem(key,jsons[key]);
		}
	}
