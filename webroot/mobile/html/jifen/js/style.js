$.func = {
    /**
     * 登录
     */
    login: function () {
        var submit = $('#loginbtn');
        $('#loginbtn').on('tap', function () {
            var user = $('#username').val();
            var inviterAccount = $('#valid').val();
            var jsoninfo = {};
            if (user == '') {
                alert('请输入手机号！');
                return;
            }
            $.ajax({
                type: 'post',
                url: 'http://182.48.107.222:8080/IntegralStore/user/login?channelId=toprays&userName=' + user + '&inviterAccount=' + inviterAccount,
                success: function (res) {
                    res = JSON.parse(res);
                    console.log(res);
                    if (res.status == 0) {
                        $.func.setCookie('userJiFen', res.data.userJiFen);
                        $.func.setCookie('headImgUrl', res.data.headImgUrl);
                        $.func.setCookie('phone', user);
                        location.href = 'home.html';
                    }
                }
            });
        });
    },
    
    /**
     * 首页商品展示
     */
    homePageProduct: function () {
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/goods/indexlist?channelId=toprays&pageSize=6&userName='+phone,
            success: function (res) {
                res = JSON.parse(res);
                console.log(res);
                if (res.status == 0) {
                    $.func.dataToTpl('product', 'tpl', res.data.homePageProductResults, function(d){
                        d.img = d.images[0];
                        if(d.productType == 8){
                            d.link = 'exchange_cash.html?id='+d.productId;
                        } else {
                            d.link = 'choose_good.html';
                        }
                        return d;
                    });
                    $.func.setCookie('userJiFen', res.data.userjifen);
                    $('#jifen').html(res.data.userjifen);
                    $('.product').on('click', function () {
                        $.func.checkjifen($('#jifen').html(), $(this).attr('link'));
                    });
                }
            }
        });
    },
    
    /**
     * 获取兑换金额
     */
    chargeMoney: function(){
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/charge/getAvailMoneyByPhone?channelId=toprays&phone='+phone,
            success: function (res) {
                res = JSON.parse(res);
                console.log(res);
                if (res.status !== 0) return false;
                if(res.data.moneys.length === 0) return false;
                for(var i=0;i<res.data.moneys.length;i++){
                    $('#chargeMoney').append('<option value="'+res.data.moneys[i]+'">'+res.data.moneys[i]+'</option>');
                };
            }
        });
    },
    
    /**
     * 获取串码号
     * @param {type} chargeNo 短信返回的串码
     */
    chargeNo:function(chargePhone, chargeNo, chargeMoney){
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/charge?channelId=toprays&userName='+phone+'&chargePhone='+chargePhone+'&money='+chargeMoney+'&chargeNumber='+chargeNo,
            success: function (res) {
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status == 0) {
                    $.func.chargeStatus(res.data.chargeNo);
                } else {
                    $('.tips').show();
                }
            }
        });
    },
    
    /**
     * 串码兑换状态
     * @param {type} chargeNo 串码号
     */
    chargeStatus: function(chargeNo){
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/charge/query?channelId=toprays&chargeNo='+chargeNo,
            success: function (res) {
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status == 0) {
                    if(res.data.chargeStatus == 4){
                        $('.tips').show();
                    } else if(res.data.chargeStatus == 1){
                        $('#chargeStatus').html('兑换成功');
                        $('#chargeTips').hide();
                    } else {
                        $.func.chargeStatus(chargeNo);
                    }
                }
            }
        });
    },
    
    /**
     * 分页获取全部商品
     * @param {type} page 页数
     */
    getProducts: function(page, size){
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/goods/list?channelId=toprays&pageIndex='+page+'&pageSize='+size,
            success: function (res) {
                window.holdLoad = false;
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status !== 0) window.holdLoad = true;
                if (res.data.products.length === 0) window.holdLoad = true;
                var html = $.func.dataToTpl('', 'tpl', res.data.products, function(d){
                    d.img = d.images[0];
                    if(d.productType == 8){
                        d.link = 'exchange_cash.html?id='+d.productId;
                    } else {
                        d.link = 'choose_good.html';
                    }
                    return d;
                });
                $('#allGoods').append(html);
                $('.product').on('click', function () {
                    $.func.checkjifen($.func.getCookie('userJiFen'), $(this).attr('link'));
                });
            }
        });
    },
    
    /**
     * 分页获取订单
     * @param {type} page 页数
     */
    getOrders: function(page, size){
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/goods/order?channelId=toprays&userName='+phone+'&pageIndex='+page+'&pageSize='+size,
            success: function (res) {
                window.holdLoad = false;
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status !== 0){
                    window.holdLoad = true;
                    $('.wraper').html($('#noOrder').html());
                    return false;
                }
                $('#totalOrders').html(res.data.totalCount);
                $('#totalMoney').html(res.data.totalMoney);
                if(res.data.totalCount == 0){
                    $('.wraper').html($('#noOrder').html());
                } else {
                    if (res.data.orders.length === 0) window.holdLoad = true;
                    var html = $.func.dataToTpl('', 'tpl', res.data.orders, function(d){
                        d.img = d.images[0];
                        switch (d.orderStatus){
                            case 1:
                                d.order_status = '购买成功';
                                break;
                            case 2:
                                d.order_status = '未付款';
                                break;
                            case 3:
                                d.order_status = '支付失败';
                                break;
                        }
                        return d;
                    });
                    $('#order').append(html);
                    $('#order_detail').show();
                }
            }
        });
    },
    
    /**
     * 指令查询
     */
    getJiFen: function(){
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/cmd/query?channelId=toprays',
            success: function (res) {
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status == 0) {
                    if(!res.data.cmds.length) return;
                    var d = {};
                    for(var i=0;i<res.data.cmds.length;i++){
                        var vendor = res.data.cmds[i].vendorName;
                        if(!d[vendor])
                            d[vendor] = [];
                        if(res.data.cmds[i].cmdType != 2){
                            d[vendor].push(res.data.cmds[i]);
                        } else {
                            $('#'+vendor).html(res.data.cmds[i].smsContent);
                        }
                    }
                    if(d['中国移动'] && d['中国移动'])
                    $.func.dataToTpl('CMCC', 'tpl', d['中国移动'], function(q){
                        return q;
                    });
                    if(d['中国联通'])
                    $.func.dataToTpl('CU', 'tpl', d['中国联通'], function(q){
                        return q;
                    });
                    if(d['中国电信'])
                    $.func.dataToTpl('CT', 'tpl', d['中国电信'], function(q){
                        return q;
                    });
                }
            }
        });
    },
    
    /**
     * 提交订单
     * @param {type} products 商品id以,分开的字符串
     */
    submitOrder: function(products){
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/goods/buy?channelId=toprays&userName='+phone+'&productsId='+products,
            success: function (res) {
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status !== 0) return false;
                location.href = 'order_query.html';
            }
        });
    },
    
    /**
     * 可以兑换的商品
     * @param {type} page 页数
     * @param {type} size 每页条数
     */
    canChargeGoods: function(page, size){
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/canchargegoods/list?channelId=toprays&pageIndex='+page+'&pageSize='+size+'&userName='+phone,
            success: function (res) {
                window.holdLoad = false;
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status !== 0) window.holdLoad = true;
                if (res.data.products.length === 0) window.holdLoad = true;
                var html = $.func.dataToTpl('', 'tpl', res.data.products, function(d){
                    d.img = d.images[0];
                    return d;
                });
                $('#goods').append(html);
            }
        });
    },
    
    /**
     * 选择商品动作
     */
    choose: function (){
        $('body').on('tap', function (e) {
            var target = e.srcElement || e.target, em = target, i = 1;
            while (em && !em.id && i <= 5) {
                em = em.parentNode;
                i++;
            }
            if (!em || !em.id) return;
            if(em.id.indexOf('product_') != -1){
                if($(em).hasClass('noTap')){
                    return;
                }
                $(em).addClass('noTap');
                var userJiFen = $.func.getCookie('userJiFen');
                var clickMoney = parseInt($(em).eq(i).find('#money').attr('money')) * 100;
                clickMoney /= 100;
                if(userJiFen < clickMoney){
                    alert('兑换余额不足');
                    $('.order_detail_item li[data-type ="0"]').addClass('noTap');
                }
                var dataType = $(em).attr('data-type');
                if (dataType == '0') {
                    $(em).find('.choosebtn').addClass('choosed');
                    $(em).attr('data-type', 1);
                    $(em).find('input').val($(em).attr('product_id'));
                } else {
                    $(em).find('.choosebtn').removeClass('choosed');
                    $(em).attr('data-type', 0);
                    $(em).find('input').val('');
                }
                var total_price = 0;
                for (var i = 0; i < $('.order_detail_item li[data-type ="1"]').length; i++) {
                    total_price += parseInt($('.order_detail_item li[data-type ="1"]').eq(i).find('#money').attr('money')) * 100;
                }
                total_price /= 100;
                if(total_price > userJiFen){
                    alert('兑换余额不足');
                    $('.order_detail_item li[data-type ="0"]').addClass('noTap');
                    $(em).find('.choosebtn').removeClass('choosed');
                    $(em).attr('data-type', 0);
                    $(em).find('input').val('');
                } else {
                    $('.order_detail_item li[data-type ="0"]').removeClass('noTap');
                }
                $(em).removeClass('noTap');
            }
        });
    },
    
    /**
     * 检查积分是否为0
     * @param {type} jifen 积分
     * @param {type} url 不为0跳转的页面
     */
    checkjifen: function(jifen, url){
        if(jifen == 0){
            alert('您的积分为0');
            return false;
        } else {
            location.href = url;
        }
    },
    
    exchangeCash: function(id, account){
        var phone = $.func.getCookie('phone');
        if(!phone) return;
        $.ajax({
            type: 'post',
            url: 'http://182.48.107.222:8080/IntegralStore/cash?channelId=toprays&userName='+phone+'&productId='+id+'&cashAccount='+account,
            success: function (res) {
                window.holdLoad = false;
                res = JSON.parse(res);
                console.log(res.data);
                if (res.status !== 0) {
                    alert(res.msg);
                    return false;
                };
                alert('您的订单号为：'+res.data.orderNo);
            }
        });
    },
    
    /**
     * 读取COOKIE
     */
    getCookie: function (name) {
        var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
        return val ? (val[2] ? unescape(val[2]).replace(/(^")|("$)/g, "") : "") : null;
    },
    /**
     * 写入COOKIES
     */
    setCookie: function (name, value, expires, path, domain, secure) {
        var exp = new Date(), expires = arguments[2] || null, path = arguments[3] || "/", domain = arguments[4] || null, secure = arguments[5] || false;
        expires ? exp.setMinutes(exp.getMinutes() + parseInt(expires)) : "";
        document.cookie = name + '=' + escape(value) + (expires ? ';expires=' + exp.toGMTString() : '') + (path ? ';path=' + path : '') + (domain ? ';domain=' + domain : '') + (secure ? ';secure' : '');
    },
    /**
     * 写入localStorge
     */
    creatStorge: function () {
        var obj = window.localStorage;
        return obj;
    },
    saveStorge: function (jsons) {
        var _obj = $.func.creatStorge();
        for (var key in jsons) {
            _obj.setItem(key, jsons[key]);
        }
    },
    readStorge: function (keyName) {
        var _obj = creatStorge();
        var readJsons = [];
        for (var i = 0; i < keyName.length; i++) {
            readJsons.push(_obj.getItem(keyName[i]));
        }
        return readJsons;
    },
    
    /**
     * 批量处理json列表数据
     * @param contentId string   容器id , 传入空字符串‘’的话，会返回组装好的html
     * @param tplId string 模板id
     * @param data json数据列表  array
     * @param func  处理json数据的方法，可选 会传入当前json对象
     * @returns {string}
     */
    dataToTpl:function(contentId, tplId, data, func){
        if(!data.length) return '';
        var html=[], tpl = $.func.id(tplId).text;
        $.each(data, function(i,d){
            if(func) d=func(d);
            html.push($.func.jsonToTpl(d,$.func.id(tplId).text));
        });
        if(contentId) $('#'+contentId).html(html.join(''));
        return html.join('');
    },
    
    //返回id查找原素，没有找到时，防止为空，会构造一个
    id:function(str){
        return document.getElementById(str) || document.createElement('span');
    },
    
    /**
     * 模板处理
     * @param json
     * @param tpl
     * @returns {XML|string|*|void}
     */
    jsonToTpl:function (json,tpl){
        return tpl.replace(/{#(\w+)#}/g,function(a,b){return json[b]===0?'0':(json[b]||'');});
    },
    
    /**
     * 获取链接的参数
     * @param {type} name 参数名
     */
    getUrlParam: function(name) {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r != null)return unescape(r[2]); return null;
   }
};
