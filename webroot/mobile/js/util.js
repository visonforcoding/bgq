$.util = {
    //返回id查找原素，没有找到时，防止为空，会构造一个
    id:function(str){
        return document.getElementById(str) || document.createElement('span');
    },

    //
    alert:function(str, t){
        $('#alertPlan').html(str);
        $('#alertPlan').show();
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
            html.push($.util.jsonToTpl(d,tpl));
        });
        return contentId === '' ? html.join('') : $('#'+contentId).html(html.join(''));
    },

    ajax:function(obj){
        var tmp = obj.func;
        obj.success = function(json){
            if(json.code == 1){
                tmp(json);
            }
            if(json.code == 2){
                // login;
            }
            if(json.code == 3){
                //$.util.alert(json.msg);
            }
            
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
            //loopScroll:(this.loopImg.length > 1 ? true:false),
            lockScrY:true,
            imgInitLazy:1000,
            loopScroll:true,
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
        var scrollHeight = $(window).scrollTop(), d = window._images_data;
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
        setTimeout(function(){window.holdLoad = false;}, 1000);  //只允许1秒加载一次下一页   防止上一个滑动事件还没有结束的状态中

        var obj = this, st = $(window).scrollTop();
        //st > this.pageHight*2 ? $('.goTopBtn').show() : $('.goTopBtn').hide();


        if (loadFunc && st >= (($(document).height() - $(window).height()) - 220)) {
            loadFunc();
            $.util.initLoadImg(listId);
        }
        $.util.loadImg();
    }

};