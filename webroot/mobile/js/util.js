$.util = {
    //返回id查找原素，没有找到时，防止为空，会构造一个
    id:function(str){
        return document.getElementById(str) || document.createElement('span');
    },

    //
    alert:function(str, t){
        $('#alertText').html(str);
        $('#alertPlan').show();
        //.css('width', $('#alertText').width()+30);
        setTimeout(function(){$('#alertPlan').hide();}, t||3000);
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
     * 批量处理json列表数据
     * @param contentId string   容器id , 传入空字符串‘’的话，会返回组装好的html
     * @param tplId string 模板id
     * @param data json数据列表  array
     * @param func  处理json数据的方法，可选 会传入当前json对象
     * @returns {string}
     */
    dataToTpl:function(contentId, tplId, data, func){
        if(!data.length) return '';
        var html=[], tpl = $.util.id(tplId).text;
        $.each(data, function(i,d){
            if(func) d=func(d);
            html.push($.util.jsonToTpl(d,$.util.id(tplId).text));
        });
        return contentId === '' ? html.join('') : $('#'+contentId).html(html.join(''));
    },
    /**
     * 去掉字符串两端空格
     * @param str
     */
    trim: function (str){
        return str.replace(/(^\s*)|(\s*$)/g, "");
    },

/**
     * 封装ajax
     * @param {type} obj
     * @returns {undefined}
     */
    ajax:function(obj){
        var tmp = obj.func;
        if(!obj['url']){
            obj['url'] = '';
        }
        if(!obj['dataType']){
            obj['dataType'] = 'json';
        }
        if(!obj['type']){
            obj['type'] = 'post';
        }
        obj.success = function(json){
            if(json.code == 200){
                tmp(json);
            }
            if(json.code == 403){
                $.util.alert('请先登录');
                setTimeout(function(){
                    window.location.href = json.redirect_url;
                },1000);
            }
            if(json.code == 500){
                var msg = Bollean(json['message'])?json['message']:json.msg;
                $.util.alert(msg);
            }
        };
        obj.statusCode= {
            404:function(){$.util.alert('请求页面不存在');},
            500:function(){$.util.alert('服务器出错');}
        };
        obj.error = function(XMLHttpRequest, textStatus, errorThrown){
          $.util.alert('服务器出错');
          console.log(errorThrown);
        };
        $.ajax(obj);
    },

    //循环轮播
    loop:function(opt){
        return new scroll(opt);
    },

    //轮播图  传入的都是
    loopImg:function(fatherDom, child, tab) {
        return $.util.loop({
            tp : 'img', //图片img或是文字text
            //min : 5,
            loadImg:true,
            moveDom : fatherDom, // eg: $('#loopImgUl')
            moveChild: child, //$('#loopImgUl li')
            tab:tab, //$('#loopImgBar li')
            loopScroll: this.loopImg.length > 1 ,
            autoTime:3000,
            lockScrY:true,
            imgInitLazy:1000,
            //loopScroll:true,
            step:$(window).width(),
            //enableTransX:true,
            index: 1,
            fun:function(index){
            }
        });
    },
    /**
     * 读取COOKIE
     */
    getCookie: function(name) {
        var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"), val = document.cookie.match(reg);
        return val ? (val[2] ? unescape(val[2]).replace(/(^")|("$)/g,"") : "") : null;
    },
    /**
     * 写入COOKIES
     */
    setCookie: function(name, value, expires, path, domain, secure) {
        var exp = new Date(), expires = arguments[2] || null, path = arguments[3] || "/", domain = arguments[4] || null, secure = arguments[5] || false;
        expires ? exp.setMinutes(exp.getMinutes() + parseInt(expires)) : "";
        document.cookie = name + '=' + escape(value) + ( expires ? ';expires=' + exp.toGMTString() : '') + ( path ? ';path=' + path : '') + ( domain ? ';domain=' + domain : '') + ( secure ? ';secure' : '');
    },

    loginWX: function(cb) {
        if(window.__isAPP){
            LEMON.login.wx(cb);
        }
        else if($.util.isWX){
            location.href = '/wx/get-user-jump';
        }
    },

    /**
     * @param id  容器dom id
     */
    showLoading:function(id){
        $('#'+id).html('<div class="loading"></div>');
    },

    /**
     * @param id  容器dom id
     */
    hideLoading:function(id){
        $('#'+id).html('');
    },


    //初始化滚动加载列表图
    initLoadImg: function(listId) {
        var data = {cache:[]}, img=$("#"+listId+" img");
        img.each(function(i) {
            var dom = $(this), init_src=dom.attr('init_src');
            init_src && data.cache.push({
                url : init_src,
                dom : dom
            });
        });
        data.num = data.cache.length;
        data.viewHeight = $(window).height();
        data.scrollOffsetH = 500;
        window._images_data = data;
        $.util.loadImg();
    },

    //滚动加载列表图
    loadImg: function(tp) {
        // 滚动条的高度
        var scrollHeight = document.body.scrollTop, d = window._images_data;
        if (!d || d.num == 0) {
            return;
        }
        // 已经卷起的高度+可视区域高度+偏移量，即当前显示的元素的高度
        visibleHeight = d.viewHeight + scrollHeight + d.scrollOffsetH;
        $.each(d.cache, function(i, data) {
            var em = data.dom, imgH =em.offset().top;
            // 图片在后面两屏范围内，并且未被加载过
            //if(tp=='detPC')$('#commDesc').append(['^'+visibleHeight, imgH].join('-'));
            if (visibleHeight > imgH && !em.attr("loaded")) {
                // 加载图片
                //em.attr('h', [d.viewHeight , scrollHeight , d.scrollOffsetH, visibleHeight, imgH].join(','))
                data.url && em.attr("src", data.url);
                em.removeAttr('init_src');
                em.attr("loaded", d.num+1);
                d.num--;
            }
        });
    },
    //滚动事件
    listScroll: function(listId, loadFunc) {
        if(window.holdLoad) return;
        window.holdLoad = true;
        //setTimeout(function(){window.holdLoad = false;}, 1000);  //只允许1秒加载一次下一页   防止上一个滑动事件还没有结束的状态中

        var obj = this, st = document.body.scrollTop;
        //st > this.pageHight*2 ? $('.goTopBtn').show() : $('.goTopBtn').hide();


        if (loadFunc && st >= (($(document).height() - $(window).height()) - 220)) {
            loadFunc();
            $.util.initLoadImg(listId);
        }
        $.util.loadImg();
    },
    
    // 搜索框滚动隐藏
    searchHide: function() {
        window.up = false;
        $(window).on('scroll', function(){
            // 滚动一定距离，搜索隐藏
            if (document.body.scrollTop > ($('#imgList').height() + $('.inner').height())) {
                $('.a-search-box').removeClass('movedown');
                $('.a-search-box').addClass('moveup');
                window.up = true;
            }
            if(document.body.scrollTop < ($('#imgList').height() + $('.inner').height()) && window.up == true){
                $('.a-search-box').addClass('movedown');
            }
        });
    }
    
};

$.util.isWX = navigator.userAgent.toLowerCase().indexOf('micromessenger') != -1;
$.util.isQQ = navigator.userAgent.toLowerCase().indexOf('qq') != -1;
$.util.isAPP = navigator.userAgent.toLowerCase().indexOf('smartlemon') != -1;