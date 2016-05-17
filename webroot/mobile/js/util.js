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
    }

};