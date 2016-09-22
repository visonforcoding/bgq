<?php

$this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="输入关键字">
            </div>
            <div class="form-group">
                <label for="keywords">时间</label>
                <input type="text" name="begin_time" class="form-control date_timepicker_start" id="keywords" placeholder="开始时间">
                <label for="keywords">到</label>
                <input type="text" name="end_time" class="form-control date_timepicker_end" id="keywords" placeholder="结束时间">
            </div>
              <div class="form-group">
                <label for="keywords">状态</label>
                <select class="form-control" name="status">
                    <option value="">全部</option>
                    <option value="0" <?php if(isset($do)): ?>selected="selected"<?php endif;?>>未审核</option>
                    <option value="1">审核通过</option>
                    <option value="2">审核不通过</option>
                </select>
            </div>
            <a onclick="doSearch();" class="btn btn-info"><i class="icon icon-search"></i>搜索</a>
            <a onclick="doExport();" class="btn btn-info"><i class="icon icon-file-excel"></i>导出</a>
        </div>
    </form>
    <table id="list"><tr><td></td></tr></table> 
    <div id="pager"></div> 
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/jqgrid/js/jquery.jqGrid.min.js"></script>
<script src="/wpadmin/lib/jqgrid/js/i18n/grid.locale-cn.js"></script>
<script>
                $(function () {
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/withdraw/getDataList<?php if(isset($do)): ?>?do=check<?php endif;?>",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                [ '提现金额', '银行卡号', '银行', '持卡人姓名', '手续费', '备注', '状态','操作人', '创建时间', '更改时间', '操作'],
                        colModel: [
                            {name: 'amount', editable: true, align: 'center'},
                            {name: 'cardno', editable: true, align: 'center'},
                            {name: 'bank', editable: true, align: 'center'},
                            {name: 'truename', editable: true, align: 'center'},
                            {name: 'fee', editable: true, align: 'center'},
                            {name: 'remark', editable: true, align: 'center'},
                            {name: 'status', editable: true, align: 'center',formatter:function(cellvalue, options, rowObject){
                                    switch(cellvalue){
                                        case 0:
                                            return '未审核';
                                        case 1:
                                            return '审核通过';
                                        case 2:
                                            return '审核不通过';
                                    }
                            }},
                            {name: 'admin.truename', editable: true, align: 'center'},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'update_time', editable: true, align: 'center'},
                            {name: 'actionBtn', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
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
                    response = ''; // '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                   if(rowObject.status==0){
                        response = '<a title="审核通过" onClick="pass(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-check"></i> </a>';
                        response += '<a title="审核不通过" onClick="unpass(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-remove-circle"></i> </a>';
                   }else{
                        response += '<a><i class="icon icon-ban-circle"></i>已审核过</a>';
                   }
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
                            url: '/admin/withdraw/delete',
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
                    //搜索
                    var postData = $('#table-bar-form').serializeArray();
                    var data = {};
                    $.each(postData, function (i, n) {
                        data[n.name] = n.value;
                    });
                    $.zui.store.pageSet('searchData', data); //本地存储查询参数 供导出操作等调用
                    $("#list").jqGrid('setGridParam', {
                        postData: data
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
                    $("body").append("<iframe src='/admin/withdraw/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/withdraw/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['380px', '70%'],
                        content: url//iframe的url
                    });
                }
                
                function pass(id) {
                    layer.confirm('确定通过审核，打款给该用户？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/withdraw/pass',
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
                function unpass(id) {
                    //需要引入layer.ext.js文件
                    layer.prompt({
                        title: '请输入审核不通过的理由',
                        btn: ['确认', '取消'], //按钮
                        formType: 2, // input.type 0:text,1:password,2:textarea
                    }, function (pass) {
                        $.ajax({
                            type: 'post',
                            data: {id:id,remark:pass},
                            dataType: 'json',
                            url: '/admin/withdraw/unpass',
                            success: function (res) {
                                layer.msg(res.msg);
                                if (res.status) {
                                    $('#list').trigger('reloadGrid');
                                }
                            }
                        });
                    }, function () {
                    });
                }
</script>
<?php
$this->end();
