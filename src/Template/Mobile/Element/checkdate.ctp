
       <style type="text/css">
        *{margin:0;padding:0;}
        	.checkdate{
        		position:fixed;
        		bottom:0;
        		max-width:750px;
        		width:100%;
        		height:180px;
        		background: #fff url(../css/img/line.png) no-repeat  0 40px;
        		-webkit-transition: height .2s ease;
        		transition: height .2s ease;
        	}
        	.hide_date{
        		height:0;
        		-webkit-transition: height .2s ease;
        		transition: height .2s ease;
        	}
        	.l_box,.r_box{
        		overflow: auto;
        		-webkit-overflow-scrolling: touch;
        		z-index:999;
        		width:50%;
        		float:left;
        		height:100px;
        		}
    		.l_box::-webkit-scrollbar,.r_box::-webkit-scrollbar{display: none;}
        	.checkdate li{line-height: 40px;height:40px;width:100%;font-size:14px;color:#ccc;}
        	/*.checkdate span{height:30px;line-height: 30px;}*/
        	.year{width:100%;overflow:hidden;text-align: center;}
        	.month{text-align: center;width:100%;overflow:hidden;}
        	.checkdate h3{text-align: center;line-height:40px;font-size:16px;}
        	.bottom_btn{height:40px;line-height: 40px;}
        	.l_sure{text-align: center;width:50%;float:left;}
        	.r_cancel{text-align: center;width:50%;float:left;}
        	.c_date{overflow:hidden;}
        	.checkdate .select{font-size:16px;color:#222;}
        	
        	
        </style>
        <div class="wraper">
           
        </div>
         <div class="checkdate">
         	<h3>请选择时间</h3>
         	<div class="c_date">
	         	<div class="l_box">
	         		
	         		<ul class="year">
                        <li val='1990'  class="select">1990年</li>
                        <li val='1992'>1992年</li>
                        <li val='1993'>1993年</li>
                        <li val='1994'>1994年</li>
                        <li val='1995'>1995年</li>
                        <li val='1996'>1996年</li>
                        <li val='1997'>1997年</li>
                        <li val='1998'>1998年</li>
                        <li val='1999'>1999年</li>
                        <li val='2000'>2000年</li>
	            		<li val='2001'>2001年</li>
	            		<li val='2002'>2002年</li>
	            		<li val='2003'>2003年</li>
	            		<li val='2004'>2004年</li>
	            		<li val='2005'>2005年</li>
	            		<li val='2006'>2006年</li>
	            		<li val='2007'>2007年</li>
                        <li val='2008'>2008年</li>
                        <li val='2009'>2009年</li>
                        <li val='2010'>2010年</li>
                        <li val='2011'>2011年</li>
                        <li val='2012'>2012年</li>
                        <li val='2013'>2013年</li>
                        <li val='2014'>2014年</li>
                        <li val='2015'>2015年</li>
                        <li val='2016'>2016年</li>
                        <li val='2017'>2017年</li>
                        <li val='2018'>2018年</li>
                        <li val='2019'>2019年</li>
                        <li val='2020'>2020年</li>
	            		<li></li>
	            		<li></li>
	            	</ul>
	         	</div>
	            	<div class="r_box">
	            		
	            		<ul class="month">
		            		<li val='01' class="select">1月</li>
		            		<li val='02'>2月</li>
		            		<li val='03'>3月</li>
		            		<li val='04'>4月</li>
		            		<li val='05'>5月</li>
		            		<li val='06'>6月</li>
		            		<li val='07'>7月</li>
		            		<li val='08'>8月</li>
		            		<li val='09'>9月</li>
		            		<li val='10'>10月</li>
		            		<li val='11'>11月</li>
		            		<li val='12'>12月</li>
		            		<li ></li>
	            			<li ></li>
	            		</ul>
	            	</div>
            	</div>
            	
            	<div class="bottom_btn">
            		
            		<span class="l_sure" onclick="hideDialog()">取消</span>
            		<span class="r_cancel" onclick="submitDialog()">确定</span>
            	</div>
            </div>
            <script type="text/javascript">

            	var _year = '2016', _month='01', _cInput;
                // 年
            	$('.r_box').on('scroll',function(){
            		var scrollTop = $(this).get(0).scrollTop;
            		var height = $('.r_box li').height();
            		var num =  Math.floor(scrollTop / height);
            		$('.r_box li').removeClass().eq(num).addClass('select');
            		_month = $('.r_box li').eq(num).attr('val');
            		    console.log(_year + '-'+_month);    		
            	})
                // 月
            	$('.l_box').on('scroll',function(){
            		var scrollTop = $(this).get(0).scrollTop;
            		var height = $('.l_box li').height();
            		var num =  Math.floor(scrollTop / height);
            		$('.l_box li').removeClass().eq(num).addClass('select');
            		_year = $('.l_box li').eq(num).attr('val');
            		    console.log(_year + '-'+_month);     		
            	})
                // 
            	function showDialog(input){
            		$('.checkdate').removeClass('hide_date');
            		_year = '2016', _month='01',
            		_cInput = input;
                    $('.r_box li').each(function(i){
                        if($(this).attr('val') == _month){
                            $('.r_box li').eq(i).scrollToView();
                        }
                    });

                    $('.l_box li').each(function(i){
                        if($(this).attr('val') == _year){
                             $('.l_box li').eq(i).scrollToView();
                        }
                    });
            		
            	}
            	function submitDialog(){
            		
            		_cInput.value = _year + '-'+_month;
            		hideDialog();
            	}
            	function hideDialog(){
            		$('.checkdate').addClass('hide_date');
            	}
            	
            </script>

