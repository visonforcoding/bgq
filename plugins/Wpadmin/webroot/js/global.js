$(function () {
//    $.datetimepicker.setLocale('zh'); //日期选择器插件
    //$('.datetime').datetimepicker({lang: 'zh'});
    $('.date_timepicker_start').datetimepicker({
        format: 'Y/m/d',
        onShow: function (ct) {
            this.setOptions({
                maxDate: $('.date_timepicker_end').val() ? $('.date_timepicker_end').val() : false
            })
        },
        timepicker: false,
        lang:'zh'
    });
    $('.date_timepicker_end').datetimepicker({
        format: 'Y/m/d',
        onShow: function (ct) {
            this.setOptions({
               minDate: $('.date_timepicker_start').val() ? $('.date_timepicker_start').val() : false
            })
        },
        timepicker: false,
        lang:'zh'
    });
    // 仅选择日期
    //图片选择器
    $('.choiceImg').on('click', function () {
        IMG_OBJ = $(this);
        iframe_index = layer.open({
            type: 2,
            title: '图片管理器',
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['960px', '550px'],
            content: '/admin/util/scanImg'
        });
    });
    //图标选择器
    $('.choiceIcon').on('click', function () {
        ICON_OBJ = $(this);
        iframe_index = layer.open({
            type: 2,
            title: '图标选择器',
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['960px', '550px'],
            content: '/wpadmin/util/icon'
        });
    });
});

//图片选择
function  choiceImg(path) {
    layer.msg('图片选取成功', {icon: 6});
    IMG_OBJ.parents('.form-group').find('img').attr('src', path);
    IMG_OBJ.parents('.form-group').find('input').val(path);
    layer.close(iframe_index);
}
//图标选择
function  choiceIcon(path) {
    layer.msg('图标选取成功', {icon: 6});
   //ICON_OBJ.parents('.form-group').find('img').attr('src', path);
    ICON_OBJ.parents('.form-group').find('input').val(path);
    layer.close(iframe_index);
}
//---------------------------------------------------  
// 日期格式化  
// 格式 YYYY/yyyy/YY/yy 表示年份  
// MM/M 月份  
// W/w 星期  
// dd/DD/d/D 日期  
// hh/HH/h/H 时间  
// mm/m 分钟  
// ss/SS/s/S 秒  
//---------------------------------------------------  
Date.prototype.Format = function (formatStr)
{
    var str = formatStr;
    var Week = ['日', '一', '二', '三', '四', '五', '六'];

    str = str.replace(/yyyy|YYYY/, this.getFullYear());
    str = str.replace(/yy|YY/, (this.getYear() % 100) > 9 ? (this.getYear() % 100).toString() : '0' + (this.getYear() % 100));

    str = str.replace(/MM/, (this.getMonth() + 1) > 9 ? this.getMonth().toString() : '0' + (this.getMonth() + 1));
    str = str.replace(/M/g, (this.getMonth() + 1));

    str = str.replace(/w|W/g, Week[this.getDay()]);

    str = str.replace(/dd|DD/, this.getDate() > 9 ? this.getDate().toString() : '0' + this.getDate());
    str = str.replace(/d|D/g, this.getDate());

    str = str.replace(/hh|HH/, this.getHours() > 9 ? this.getHours().toString() : '0' + this.getHours());
    str = str.replace(/h|H/g, this.getHours());
    str = str.replace(/mm/, this.getMinutes() > 9 ? this.getMinutes().toString() : '0' + this.getMinutes());
    str = str.replace(/m/g, this.getMinutes());

    str = str.replace(/ss|SS/, this.getSeconds() > 9 ? this.getSeconds().toString() : '0' + this.getSeconds());
    str = str.replace(/s|S/g, this.getSeconds());

    return str;
};


/**
 * jquery-file-upload 上传插件初始化 消息弹出依赖layer.js
 * @link http://hayageek.com/docs/jquery-upload-file.php#doc
 * @param {type} id 上传触发按钮
 * @param {type} url 
 * @param {type} allowedTypes
 * @returns {undefined}
 */
function initJqupload(id, url, allowedTypes) {
    var uploadObj = $('#' + id).uploadFile({
        url: url,
        returnType: 'json',
        maxFileCount: 1,
        allowedTypes: allowedTypes,
        doneStr: "上传完成",
        dragDrop: false,
        multiple: false,
        showDone: true,
        uploadStr: "重置图片",
        showStatusAfterSuccess: false,
        maxFileCountErrorStr: "不被允许,允许的最大数量为",
        dragDropStr: "<span><b>试试拖动文件上传</b></span>",
        extErrorStr: "类型不允许,允许类型如下:",
        multiDragErrorStr: '这里只能一次上传一张',
        customErrorKeyStr: '上传发生了错误',
        onSuccess: function (files, data, xhr, pd) {
            if (data.status) {
                $('#' + id).prevAll('.img-thumbnail').find('img').attr('src', data.url);
                $('#' + id).parent('.input-img-box').children('input').val(data.url);
            } else {
                uploadObj.reset();
                layer.alert(data.msg);
            }
        },
        onSelect: function (files)
        {
            uploadObj.reset();  //单个图片上传的 委曲求全的办法
        },
        onError: function (files, status, errMsg, pd) {
            console.log(status);
        }
    });
}