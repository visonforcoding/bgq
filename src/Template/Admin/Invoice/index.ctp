<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/invoice/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="用户名、公司、快递单号">
            </div>
            <div class="form-group">
                <label for="is_VAT">发票类型</label>
                <select class="form-control" name="is_VAT">
                    <option value="all_VAT">全部</option>
                    <option value="1">增值税发票</option>
                    <option value="2">普通发票</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_shipment">发货情况</label>
                <select class="form-control" name="is_shipment">
                    <option value="all_shipment">全部</option>
                    <option value="0">未发货</option>
                    <option value="1">已发货</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keywords">时间</label>
                <input type="text" name="begin_time" class="form-control date_timepicker_start" id="keywords" placeholder="开始时间">
                <label for="keywords">到</label>
                <input type="text" name="end_time" class="form-control date_timepicker_end" id="keywords" placeholder="结束时间">
            </div>
            <a onclick="doSearch();" class="btn btn-info"><i class="icon icon-search"></i>搜索</a>
            <!--<a onclick="doExport();" class="btn btn-info"><i class="icon icon-file-excel"></i>导出</a>-->
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
                $('#select-user').select2({
                    language: "zh-CN",
                    placeholder: '选择一个用户'
                });
                $(function () {
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $(document).keypress(function (e) {
                        if (e.which == 13) {
                            doSearch();
                        }
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/invoice/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['用户', '发票类型', '公司名称', '总金额', '收件人', '收件人电话', '收件人地址', '发货情况', '快递', '快递单号', '申请时间', '发货时间', '操作'],
                        colModel: [
                            {name: 'user.truename', editable: true, align: 'center'},
                            {name: 'is_VAT', editable: true, align: 'center', formatter: function (cell, options, row) {
                                    if (cell == 1) {
                                        return '增值税发票';
                                    } else {
                                        return '普通发票';
                                    }
                                }},
                            {name: 'company', editable: true, align: 'center'},
                            {name: 'sum', editable: true, align: 'center', formatter: function (cell, options, row) {
                                    return cell + '元';
                                }},
                            {name: 'recipient', editable: true, align: 'center'},
                            {name: 'recipient_phone', editable: true, align: 'center'},
                            {name: 'recipient_address', editable: true, align: 'center'},
                            {name: 'is_shipment', editable: true, align: 'center', formatter: function (cell, options, row) {
                                    if (cell == 1) {
                                        return '已发货';
                                    } else {
                                        return '待发货';
                                    }
                                }},
                            {name: 'shipment_express', editable: true, align: 'center'},
                            {name: 'shipment_number', editable: true, align: 'center'},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'update_time', editable: true, align: 'center'},
                            {name: 'actionBtn', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
                        pager: "#pager",
                        rowNum: 10,
                        rowList: [10, 20, 30],
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
//                    response = '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
//                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-eye-open"></i> </a>';
                    response = '<a title="查看" href="/admin/invoice/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    if (rowObject.is_shipment != 1) {
                        response += '<a title="发货" href="javascript:void(0)" onClick="doShipment(' + rowObject.id + ');" class="grid-btn "><i class="icon icon-cube"></i> </a>';
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
                            url: '/admin/invoice/delete',
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
                    $("body").append("<iframe src='/admin/invoice/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/invoice/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['45%', '70%'],
                        content: url//iframe的url
                    });
                }
                function doShipment(id) {
                    //查看明细
                    url = '/admin/invoice/view/' + id;
                    layer.open({
                        type: 2,
                        title: '发货',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['45%', '70%'],
                        content: url//iframe的url
                    });
                }
</script>
<?php
$this->end();
