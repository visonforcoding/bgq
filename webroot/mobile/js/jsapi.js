/**
 * JSAPI内部实现    JSApi.invoke("shareWX", JSON.stringify(msg), "callback");
 */

/**
 * 外部调用方法，如 ： var result = LEMON.shareWX(param, callback);
 * @param json格式参数列表,默认为空
 * @callback 回调函数，默认为空，回调执行时参数为{callback:'',data:{}},callback为当前函数名称，data为result.data
 * @result
 {
   code:0,      //0表示正确执行，其他表示相应错误码
   errorMsg:'', //错误信息
   data:{}      //对于取结果的，数据会以json结构放在data里，否则data为空json
 }
 */
(function () {
    var defaultConfig = {
        img_url: 'http://m.jealousauto.com/static/user/image/zmc_logo_1.png',
        img_width: "80",
        img_height: "80",
        link: 'http://m.jealousauto.com/',
        title: '并购菁英汇',
        desc: '并购菁英汇'
    };
    window.shareConfig = defaultConfig;
    window.nativeShare = function (type) {
        LEMON.share[type](window.shareConfig, function () {
        });
    };
    window.onBottom = window.onBottom || function () {
    };
    window.onActiveView = window.onActiveView || function () {
    };
    var LEMON = {};
    window.__isAPP = LEMON.isAPP = window.JSApi || navigator.userAgent.toLowerCase().indexOf("smartlemon") >= 0;  //判断页面是否在app的环境中

    var isAPP = LEMON.isAPP;
    var registerAPI = function (obj, names, fun) {
        var n = names.replace(/\..*/, '');
        obj = obj || LEMON;
        obj[n] = obj[n] || {};
        n == names ? obj[n] = fun : registerAPI(obj[n], names.replace(n + '.', ''), fun);
    };

    //apiCB为空的时候  api不会执行回调
    var JSApiInvoke = function (api, param, apiCB, reType) {
        var re = reType == 'string' ? '{"data":""}' : '{"code": 1, "errorMsg": "invoke error", "data": ""}';  //约定的执行报错返回格式
        if (isAPP) {
            try {
                return JSApi.invoke(api, JSON.stringify(param), apiCB);
            }
            catch (e) {
                return re;
            }
        }
        return re;
    };

    var apiCallback = function (func) {
        if (!func) return '';
        var apiCB = 'apiCB' + Math.ceil(Math.random() * 1000000000000);
        window[apiCB] = function (param) {
            func && func(param);
            delete window[apiCB];
        };
        return apiCB;
    };

    //api名称列表
    var apiList = ["db.get",
        "db.set",
        "sys.version",
        "sys.QRcode",
        "hide.share", //隐藏分享图标
        "show.search", //显示搜索
        "share.banner",
        "share.QQ",
        "share.QQfriend",
        "share.WX",
        "share.WXfriend",
        "share.WB",
        "env.hasQQ",
        "env.hasWX",
        'login.wx',
        "event.getLocation",
        "event.tel",
        "event.uploadPhoto",
        "event.reuploadPhoto"];

    for (var i = 0, len = apiList.length; i < len && apiList[i]; i++) {
        (function (api) { //api eg:'share.qq'
            switch (api) {
                case "db.get":
                case "db.set":
                    registerAPI(null, api, function () {
                        var param = {
                            'key': arguments[0],
                            'content': arguments[1] || '',
                            'expires': arguments[2] || 999999
                        };
                        if (!param['key']) return '';
                        if (!isAPP) {
                            if (api == 'db.set') localStorage.setItem(param['key'], param['content']);
                            if (api == 'db.get') return localStorage.getItem(param['key']);
                            return '';
                        }

                        //db.get只用到key  LEMON.db.get 只需要传入一个字符串
                        // ** db.set至少用到key value  LEMON.db.set  至少传入两个参数，字符串  **
                        // invoke可以多传几个变量 set  delete不会用到value和get
                        var invokeResult = JSApiInvoke(api, param, '', 'string');
                        //alert(invokeResult);
                        var re = JSON.parse(invokeResult);
                        return re.data;
                    });
                    break;


                case "sys.version":
                    registerAPI(null, api, function () {
                        var invokeResult = JSApiInvoke(api, '', '', 'string');
                        //alert(invokeResult);
                        var re = JSON.parse(invokeResult);
                        return re.data;
                    });
                    break;
                //无参数   无回调
                case "share.banner":
                case "hide.share":
                case "sys.QRcode":
                    registerAPI(null, api, function () {
                        return JSApiInvoke(api, {}, '');
                    });
                    break;
                //一个字符型参数   无回调
                case "show.search":
                    registerAPI(null, api, function () {
                        return JSApiInvoke(api, {url:arguments[0]}, '');
                    });
                    break;
                case "event.tel":
                    registerAPI(null, api, function () {
                        return JSApiInvoke(api, {tel:arguments[0]}, '');
                    });
                    break;
                //无参数 只用到callback
                case "event.getLocation":
                case "event.uploadPhoto":
                    registerAPI(null, api, function () {
                        JSApiInvoke(api, {}, apiCallback(arguments[0]));
                    });
                    break;
                case "event.reuploadPhoto":
                    registerAPI(null, api, function () {
                        window.reuploadPhotoCB = arguments[0];
                        return JSApiInvoke(api, {}, '');
                        //var re = JSON.parse(JSApiInvoke(api, {}, '', 'string'));
                        //return re.data;
                    });
                    break;
                case "share.banner":
                case "share.QQ":
                case "share.QQfriend":
                case "share.WX":
                case "share.WXfriend":
                case "share.WB":
                    registerAPI(null, api, function () {
                        var param = arguments[0] || window.shareConfig, cb = arguments[1] || function () {
                            }; //这里ios一定要callback
                        if (!param) return '';
                        if (!isAPP) {
                            //register wx sq
                        }
                        return JSApiInvoke(api, {
                            title: param.title,
                            desc: param.desc,
                            img_url: param.img_url,
                            link: param.link,
                            img_width: param.img_width || 80,
                            img_heigth: param.img_height || 80
                        }, apiCallback(cb));
                    });
                    break;
                case 'login.wx':
                    registerAPI(null, api, function() {
                        var cb = arguments[0] || function(){};
                        return JSApiInvoke(api, {}, apiCallback(function(code){
                            $.ajax('/loginxxx/'+code, function(json){
                                //json todo
                                cb();
                            });
                        }));
                    });
                break;

                default:
                    registerAPI(null, api, function () {
                        return JSApiInvoke(api, {}, '');
                    });
                    break;
            }
        })(apiList[i]);
    }
    window.LEMON = LEMON;
})();

//LEMON.db.set('name','kate');

//setStringWithKey=>db.set------------key:value==>{key:str, content:str}
//getStringWithKey=>db.get------------key:value==>{key:value}
//getLocation=>db.set------------key:value==>{key:value}
//setStringWithKey=>db.set------------key:value==>{key:value}
//setStringWithKey=>db.set------------key:value==>{key:value}


