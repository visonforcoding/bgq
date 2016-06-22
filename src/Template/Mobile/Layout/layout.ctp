<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection"content="telephone=no, email=no" />
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title><?= isset($pageTitle) ? $pageTitle : '并购圈' ?></title>
        <link rel="stylesheet" type="text/css" href="/mobile/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="/mobile/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="/mobile/font/font/iconfont.css">
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript" src="/mobile/js/jsapi.js"></script>
        <script type="text/javascript" src="/mobile/js/zepto.min.js"></script>
        <script type="text/javascript" src="/mobile/js/view.js"></script>
        <script>
            (function(){  //微信分享
                if(navigator.userAgent.toLowerCase().indexOf('micromessenger') != -1){
                    var n=0;
                    var wxReadTimmer = setInterval(function(){
                        n++;
                        if(n>30) clearInterval(wxReadTimmer);
                        if(window.wx){
                            clearInterval(wxReadTimmer);
                            wx.config(<?=json_encode($wxConfig)?>);
                            wx.ready(function(){
                                wx.onMenuShareTimeline(window.shareConfig);
                                wx.onMenuShareAppMessage(window.shareConfig);
                                wx.onMenuShareQQ(window.shareConfig);
                                wx.onMenuShareWeibo(window.shareConfig);
                                wx.onMenuShareQZone(window.shareConfig);
                            });
                        }
                    },500);
                }
            })();
        </script>
        <?= $this->fetch('static') ?>
    </head>
    <body>
        <?= $this->fetch('content') ?>
        <script type="text/javascript" src="/mobile/js/util.js"></script>
        <script type="text/javascript" src="/mobile/js/function.js"></script>
        <script>
            (function(){
                if(!/smartlemon|micromessenger/.test(navigator.userAgent.toLowerCase())){
                    $('header').show();
                }else{
                    $($('.wraper')[0]).css('padding-top','0');
                }

                if(navigator.userAgent.toLowerCase().indexOf('smartlemon') == -1){
                    $('footer').show();
                }
            })();

            (function(){
                if(!$.util.isAPP)  return;
                var apptk = LEMON.db.get('token_uin'), cookietk = $.util.getCookie('token_uin');
                if(apptk && cookietk){
                    return;
                }
                else if(apptk){
                    $.util.setCookie('token_uin', apptk, 99999999);
                }
                else if(cookietk){
                    LEMON.db.set('token_uin', cookietk);
                }
            })()

        </script>


        <script>

            window.onerror = function (a,b,c,d,e) {
                function f(a) {
                    var b, c;
                    if ("object" == typeof a) {
                        if (null === a)
                            return "null";
                        if (window.JSON && window.JSON.stringify)
                            return JSON.stringify(a);
                        c = g(a), b = [];
                        for (var d in a)
                            b.push(( c ? "" : '"' + d + '":') + f(a[d]));
                        return b = b.join(), c ? "[" + b + "]" : "{" + b + "}";
                    }
                    return "undefined" == typeof a ? "undefined" : "number" == typeof a || "function" == typeof a ? a.toString() : a ? '"' + a + '"' : '""';
                }

                function g(a) {
                    return "[object Array]" == Object.prototype.toString.call(a);
                }

                var h, i = window;
                if ( d = d || i.event && i.event.errorCharacter || 0, e && e.stack){
                    a = e.stack.toString();
                }
                else if (arguments.callee) {
                    for (var j = [a], k = arguments.callee.caller, l = 3; k && --l > 0 && (j.push(k.toString()), k !== k.caller); )
                        k = k.caller;
                    j = j.join(","), a = j;
                }
                if ( h = f(a) + ( b ? ";URL:" + b : "") + ( c ? ";Line:" + c : "") + ( d ? ";Column:" + d : ""), i._last_err_msg) {
                    if (i._last_err_msg.indexOf(a) > -1)
                        return;
                    i._last_err_msg += "|" + a;
                } else
                    i._last_err_msg = a;

                setTimeout(function() {
                    console.log("ERROR:" + h);
                    alert("JS ERROR:" + h);
                    //var a = encodeURIComponent(h), b = new Image;
                    //b.src = "//wq.jd.com/webmonitor/collect/badjs.json?Content=" + a + "&t=" + Math.random();
                    //当前用户登录ID、时间、手机号码、上报URL
                    //b.src = "/BadJS/index.html?Content=" + a + "&t=" + Math.random();

                }, 500);

                return !1
            };
        </script>



        <?= $this->fetch('script') ?>
        <div class="alert" id="alertPlan" style="display: none"><span id="alertText"></span></div>
    </body>
</html>
