<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/activityapply/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="输入关键字">
            </div>
            <div class="form-group">
                <label for="must_check">是否需要审核</label>
                <select name="must_check" class="form-control">
                    <option value="">全部</option>
                    <option value="1"<?php if(isset($do)): ?>selected="selected"<?php endif;?>>需要</option>
                    <option value="0">不需要</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">是否审核</label>
                <select name="is_check" class="form-control">
                    <option value="">全部</option>
                    <option value="1">已审核</option>
                    <option value="0" <?php if(isset($do)): ?>selected="selected"<?php endif;?>>未审核</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keywords">时间</label>
                <input type="text" name="begin_time" class="form-control date_timepicker_start" id="keywords" placeholder="开始时间">
                <label for="keywords">到</label>
                <input type="text" name="end_time" class="form-control date_timepicker_end" id="keywords" placeholder="结束时间">
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
                        url: "/admin/activityapply/getDataList/<?= $id ?><?php if(isset($do)): ?>?do=check<?php endif;?>",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['用户','公司','职位', '活动', '提交时间','是否需审核', '审核状态', '报名状态','审核人','是否置顶', '是否签到', '操作'],
                        colModel: [
                            {name: 'user.truename', editable: true, align: 'center'},
                            {name: 'user.company', editable: true, align: 'center'},
                            {name: 'user.position', editable: true, align: 'center'},
                            {name: 'activity.title', editable: true, align: 'center'},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'activity.must_check', editable: true, align: 'center',formatter:function(cellvalue, options, rowObject){
                                    if(cellvalue=='1'){
                                        return '是';
                                    }else{
                                        return '否';
                                    }
                            }},
                            {name: 'is_check', editable: true, align: 'center',formatter:function(cellvalue, options, rowObject){
                                    switch(cellvalue){
                                        case 0:
                                            return '未审核';
                                        case 1:
                                            return '审核通过';
                                        case 2:
                                            return '审核不通过';
                                    }
                            }},
                            {name: 'is_pass', editable: true, align: 'center',formatter:function(cellvalue, options, rowObject){
                                    console.log(+rowObject.activity.apply_fee>0?'<i class="notice">(已付款)</i>':'');
                                    if(cellvalue){
                                       if(rowObject.activity.apply_fee>0){
                                           return '通过<span class="notice">(已付款)</span>';
                                       }
                                    }else{
                                        return '未通过';
                                    }
                            }},
                            {name: 'check_man', editable: true, align: 'center'},
                            {name: 'is_top', editable: true, align: 'center', formatter: topFormatter},
                            {name: 'is_sign', editable: true, align: 'center', formatter: signFormatter},
                            {name: 'actionBtn', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
                        pager: "#pager",
                        rowNum: 30,
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

                function passFormatter(cellvalue, options, rowObject) {
                    if (rowObject.is_pass == 0)
                    {
                        response = '未通过审核';
                    } else if (rowObject.is_pass == 1)
                    {
                        response = '已通过审核';
                    }
                    return response;
                }

                function topFormatter(cellvalue, options, rowObject) {
                    if (rowObject.is_top == 0)
                    {
                        response = '否';
                    } else if (rowObject.is_top == 1)
                    {
                        response = '是';
                    }
                    return response;
                }

                function signFormatter(cellvalue, options, rowObject) {
                    if (rowObject.is_sign == 0)
                    {
                        response = '否';
                    } else if (rowObject.is_sign == 1)
                    {
                        response = '是';
                    }
                    return response;
                }

                function actionFormatter(cellvalue, options, rowObject) {
                    response = ''; // '<a title="删除" href="javascript:void(0)" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    if (rowObject.is_top == 0){
                        response += '<a title="置顶" href="javascript:void(0)" onClick="topit(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn ">置顶</a>';
                    } else{
                        response += '<a title="取消置顶" href="javascript:void(0)" onClick="untop(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn ">取消置顶</a>';
                    }
                   if(rowObject.activity.must_check==1){
                        response += '<a title="审核通过" onClick="check(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-check"></i> </a>';
                        response += '<a title="审核不通过" onClick="uncheck(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-remove-circle"></i> </a>';
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
                            url: '/admin/activityapply/delete',
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

                function topit(id) {
                    layer.confirm('确定置顶？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activityapply/top/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.msg(res.msg);
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2000);
                                }
                            }
                        })
                    }, function () {
                    });
                }

                function untop(id) {
                    layer.confirm('确定取消置顶？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activityapply/untop/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.msg(res.msg);
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2000);
                                }
                            }
                        })
                    }, function () {
                    });
                }

                function check(id) {
                    layer.confirm('确定通过审核？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activityapply/check/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.msg(res.msg);
                                    setTimeout(function () {
                                         $('#list').trigger('reloadGrid');
                                    }, 2000);
                                }
                            }
                        });
                    }, function () {
                    });
                }
                function uncheck(id) {
                    layer.confirm('确定不通过审核？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activityapply/uncheck/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.msg(res.msg);
                                    setTimeout(function () {
                                         $('#list').trigger('reloadGrid');
                                    }, 2000);
                                }
                            }
                        });
                    }, function () {
                    });
                }

                function unpass(id) {
                    layer.confirm('确定不通过审核？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activityapply/unpass/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.msg(res.msg);
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2000);
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
                    $("body").append("<iframe src='/admin/activityapply/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/activityapply/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['380px', '70%'],
                        content: url//iframe的url
                    });
                }
</script>
<?php
$this->end();
