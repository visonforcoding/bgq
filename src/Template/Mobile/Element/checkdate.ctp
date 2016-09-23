<style type="text/css">
    *{margin:0;padding:0;}
    .checkdate{
        position:fixed;
        bottom:0;
        max-width:750px;
        width:100%;
        height:180px;
        background: #fff url(/mobile/css/img/line.png) repeat-x  0 40px;
        -webkit-transition: height .2s ease;
        transition: height .2s ease;
        -webkit-box-shadow: 0 0 15px rgba(0,0,0,.2);
        box-shadow: 0 0 15px rgba(0,0,0,.2);
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
<div class="checkdate hide_date">
    <h3>请选择时间</h3>
    <div class="c_date">
        <div class="l_box">

            <ul class="year">
                
                <?php for($i=40; $i>=0; $i--): ?>
                    <li val='<?= date('Y')-$i ?>'><?= date('Y')-$i ?>年</li>
                <?php endfor; ?>
                <li val="至今">至今</li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="r_box">

            <ul class="month">
                <li val='01'>1月</li>
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

    var _year = '2016', _month = '01', _func;
    // 年
    $('.r_box').on('scroll', function () {
        var scrollTop = $(this).get(0).scrollTop;
        var height = $('.r_box li').height();
        var num = Math.floor(scrollTop / height);
        $('.r_box li').removeClass().eq(num).addClass('select');
        _month = $('.r_box li').eq(num).attr('val');
        console.log(_year + '-' + _month);
    });
    // 月
    $('.l_box').on('scroll', function () {
        var scrollTop = $(this).get(0).scrollTop;
        var height = $('.l_box li').height();
        var num = Math.floor(scrollTop / height);
        $('.l_box li').removeClass().eq(num).addClass('select');
        _year = $('.l_box li').eq(num).attr('val');
        console.log(_year + '-' + _month);
    })
    // 显示
    function showDialog(func) {
        LEMON.sys.hideKeyboard();
        $('.checkdate').removeClass('hide_date');
        _cfunc = func;
        $('.r_box li').each(function (i) {
            if ($(this).attr('val') == _month) {
                this.scrollIntoView(true);
            }
        });

        $('.l_box li').each(function (i) {
            if ($(this).attr('val') == _year) {
                this.scrollIntoView(true);
            }
        });
            
        
    }
    // 确定
    function submitDialog() {
        if(_cfunc){
            if(_year === '至今'){
                _cfunc('至今');
            } else {
                _cfunc(_year + '-' + _month);
            }
        }
        hideDialog();
    }
    // 隐藏
    function hideDialog() {
        $('.checkdate').addClass('hide_date');
    }

</script>

