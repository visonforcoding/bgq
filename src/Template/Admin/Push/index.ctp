<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
<!--            <div class="form-group">
                <label for="keywords">类别</label>
                <select id="cate" class="form-control" name="type">
                    <option></option>
                    <option value="1" id="cate_activity">活动</option>
                    <option value="2" id="cate_industry">标签</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keywords">活动</label>
                <?= $this->cell('ActivityRecommend', [['single']]); ?>
            </div>-->
            <div class="form-group">
                <label for="keywords">标签</label>
                <?=$this->cell('Industry::push',[['single']])?>
            </div>
            <div class="form-group">
                <label for="keyword">关键字</label>
                <input type="text" name="keyword" class="form-control" id="keywords" placeholder="用户名、电话">
            </div>
            <a onclick="doSearch();" class="btn btn-info">预览用户</a>
            <a onclick="doPush();" class="btn btn-info">推送</a>
            <input type="hidden" name="val" value="">
        </div>
    </form>
    <table id="list"><tr><td></td></tr></table>
    <div id="pager"></div>
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/jqgrid/js/jquery.jqGrid.min.js"></script>
<script src="/wpadmin/lib/jqgrid/js/i18n/grid.locale-cn.js"></script>
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<script>
                $('#select-activity').select2({
                    language: "zh-CN",
                    placeholder: '选择一个活动'
                });
                $('#cate').select2({
                    language: "zh-CN",
                    placeholder: '类别'
                });
                $('#select-industry').select2({
                    language: "zh-CN",
                    placeholder: '选择一个标签'
                });
                
                $(function () {
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/push/getDataList",
                        datatype: "local",
                        mtype: "POST",
                        colNames:
                                ['手机号', '姓名', '类型', '等级', '公司', '职位', '性别', '会员认证', '帐号状态', '创建时间'],
                        colModel: [
                            {name: 'phone', editable: false, align: 'center'},
                            {name: 'truename', editable: false, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    return '<a title="查看" onClick="showUser(' + " ' " + rowObject.id + " ' " + ');" class="grid-btn ">' + cellvalue + '</a>';
                                }},
                            {name: 'level', editable: false, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    if (cellvalue == '1') {
                                        return '普通';
                                    } else {
                                        return '会员';
                                    }
                                }},
                            {name: 'grade', editable: false, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    switch (cellvalue) {
                                        case 1:
                                            return '普通';
                                        case 2:
                                            return '高级';
                                        case  3:
                                            return 'vip';
                                    }
                                }},
                            {name: 'company', editable: false, align: 'center'},
                            {name: 'position', editable: false, align: 'center'},
                            {name: 'gender', editable: false, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    if (cellvalue == '1') {
                                        return '男';
                                    } else {
                                        return '女';
                                    }
                                }},
                            {name: 'savant_status', editable: false, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    switch (cellvalue) {
                                        case 1:
                                            return '未认证';
                                        case 2:
                                            return '<i style="color:red">待审核</i>';
                                        case  3:
                                            return '审核通过';
                                        case 0:
                                            return '审核不通过';
                                    }
                                }, edittype: 'select', editoptions: {value: "1:未认证;2:待审核;3:审核通过;0:审核不通过"}},
                            {name: 'enabled', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    switch (cellvalue) {
                                        case true:
                                            return '<button onClick="ableUser(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-check-circle"></i> 正常</button>';
                                        case false:
                                            return '<button onClick="ableUser(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-remove-circle"></i><i style="color:red"> 已禁用</i></button>';
                                    }
                                }, edittype: 'select', editoptions: {value: "1:正常;0:禁用"}},
                            {name: 'create_time', editable: true, align: 'center'}],
                        pager: "#pager",
                        rowNum: window._config.showDef,
                        rowList: window._config.pages,
                        sortname: "id",
                        sortorder: "desc",
                        viewrecords: true,
                        gridview: true,
                        autoencode: true,
                        caption: '',
                        autowidth: true,
                        height: 'auto',
                        rownumbers: true,
                        fixed: true,
                        multiselect: false,
                        jsonReader: {
                            root: "rows",
                            page: "page",
                            total: "total",
                            records: "records",
                            repeatitems: false,
                            id: "id"
                        },
                    }).navGrid('#pager', {edit: false, add: false, del: false, view: true});
                });

                function actionFormatter(cellvalue, options, rowObject) {
                    response = '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-eye-open"></i> </a>';
                    response += '<a title="编辑" href="/admin/rd/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    return response;
                }

                function delRecord(id) {
                    layer.confirm('确定删除？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/rd/delete',
                            success: function (res) {
                                layer.msg(res.msg);
                                if (res.status) {
                                    $('#list').trigger('reloadGrid');
                                }
                            }
                        })
                    }, function () {
                    });
                }

                function doSearch() {
//                    if($('#cate').val() == ''){
//                        layer.alert('请先选择一个类别');
//                        return;
//                    } else if($('#cate').val() == 1 && $('#select-activity').val() == ''){
//                        layer.alert('请选择一个活动');
//                        return;
//                    } else if($('#cate').val() == 2 && $('#select-industry').val() == ''){
                    if($('#select-industry').val() == ''){
                        layer.alert('请选择一个标签');
                        return;
                    }
                    var postData = $('#table-bar-form').serializeArray();
                    var data = {};
                    $.each(postData, function (i, n) {
                        data[n.name] = n.value;
                    });
                    $.zui.store.pageSet('searchData', data); //本地存储查询参数 供导出操作等调用
                    $("#list").jqGrid('setGridParam', {
                        postData: data,
                        datatype: 'json'
                    }).trigger("reloadGrid");
                }

                function doExport() {
                    //导出excel
                    var sortColumnName = $("#list").jqGrid('getGridParam', 'sortname');
                    var sortOrder = $("#list").jqGrid('getGridParam', 'sortorder');
                    var searchData = $.zui.store.pageGet('searchData') ? $.zui.store.pageGet('searchData') : {};
                    searchData['sidx'] = sortColumnName;
                    searchData['sort'] = sortOrder;
                    var searchQueryStr = $.param(searchData);
                    $("body").append("<iframe src='/admin/rd/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/rd/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['380px', '70%'],
                        content: url//iframe的url
                    });
                }

                function doPush() {
//                    if($('#cate').val() == ''){
//                        layer.alert('请先选择一个类别');
//                        return;
//                    } else if($('#cate').val() == 1 && $('#select-activity').val() == ''){
//                        layer.alert('请选择一个活动');
//                        return;
//                    } else if($('#cate').val() == 2 && $('#select-industry').val() == ''){
                    if($('#select-industry').val() == ''){
                        layer.alert('请选择一个标签');
                        return;
                    }
//                    var type = $('#cate').val();
//                    var id = '';
//                    if(type == 1){
//                        id = $('#select-activity').val();
//                    } else if(type == 2) {
                    var id = $('#select-industry').val();
//                    }
                    //iframe层-父子操作
                    layer.open({
                        type: 2,
                        title: '推送内容',
                        area: ['70%', '50%'],
                        shadeClose: true,
                        shade: 0.8,
                        content: '/admin/push/view/'+id
                    });
                }
                
                $('#select-activity').change(function(){
                    if($('#select-activity').val() != ''){
                        $('#cate').val(1).trigger('change');
                        $('#select-industry').val('').trigger('change');
                    }
                });
                
                $('#select-industry').change(function(){
                    if($('#select-industry').val() != ''){
                        $('#cate').val(2).trigger('change');
                        $('#select-activity').val('').trigger('change');
                    }
                });
</script>
<?php
$this->end();
