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
     * @param contentId  容器id string
     * @param tplId  模板id string
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
        $('#'+contentId).html(html.join(''));
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
        $.util.loop({
            tp : 'img', //图片img或是文字text
            //min : 5,
            loadImg:true,
            moveDom : fatherDom, // eg: $('#loopImgUl')
            moveChild: child, //$('#loopImgUl li')
            tab:tab, //$('#loopImgBar li')
            //loopScroll:(this.loopImg.length > 1 ? true:false),
            lockScrY:true,
            imgInitLazy:1000,
            //enableTransX:true,
            index: 1,
            fun:function(index){
            }
        });
    }

};