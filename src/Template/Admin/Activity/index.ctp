<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/activity/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="用户、标题、公司、地址">
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
                        url: "/admin/activity/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        colNames: ['id', '作者', '标签', '主办单位', '活动名称', '活动时间', '地区', '地点', '规模', '阅读数', '点赞数', '评论数', '是否众筹', '报名人数', '报名费用', '创建时间', '更新时间', '操作'],
                        colModel: [
                            {name: 'id', editable: true, align: 'center'},
                            {name: 'user.truename', editable: true, align: 'center'},
                            {name: 'industries', editable: true, align: 'center', formatter: industryFormatter},
                            {name: 'company', editable: true, align: 'center'},
                            {name: 'title', editable: true, align: 'center'},
                            {name: 'time', editable: true, align: 'center'},
                            {name: 'region.name', editable: true, align: 'center'},
                            {name: 'address', editable: true, align: 'center'},
                            {name: 'scale', editable: true, align: 'center'},
                            {name: 'read_nums', editable: true, align: 'center'},
                            {name: 'praise_nums', editable: true, align: 'center'},
                            {name: 'comment_nums', editable: true, align: 'center'},
                            {name: 'is_crowdfunding', editable: true, align: 'center', formatter: crowdFormatter},
                            {name: 'apply_nums', editable: true, align: 'center'},
                            {name: 'apply_fee', editable: true, align: 'center'},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'update_time', editable: true, align: 'center'},
                            {name: 'actionBtn', width: '200%', align: 'left', viewable: false, sortable: false, formatter: actionFormatter}],
                        pager: "#pager",
                        rowNum: 30,
                        rowList: [10, 20, 30],
                        sortname: "create_time",
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
                            id: "0"
                        },
                    }).navGrid('#pager', {edit: false, add: false, del: false, view: true});
                });

                function crowdFormatter(cellvalue, options, rowObject) {
                    if (rowObject.is_crowdfunding == 0)
                    {
                        response = '否';
                    } else
                    {
                        response = '是';
                    }

                    return response;
                }

                function actionFormatter(cellvalue, options, rowObject) {
                    response = '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-eye-open"></i> </a>';
                    response += '<a title="编辑" href="/admin/activity/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    if (rowObject.is_top == 0 && rowObject.is_check == 1) {
                        response += '<a title="置顶" href="javascript:void(0)" class="grid-btn top" onclick="istop(' + rowObject.id + ')"><i class="icon icon-long-arrow-up"></i> </a>';
                        response += '<a title="签到二维码" href="javascript:void(0)" class="grid-btn" onclick="oncode(' + rowObject.id + ');"><i class="icon icon-qrcode"></i><div hidden id="code_' + rowObject.id + '" style="position:relative;top:0;"><img src="' + rowObject.qrcode + '" /></div> </a>';
                    } else if (rowObject.is_top == 1 && rowObject.is_check == 1) {
                        response += '<a title="取消置顶" href="javascript:void(0)" class="grid-btn untop" onclick="untop(' + rowObject.id + ')"><i class="icon icon-long-arrow-down"></i></a>';
                        response += '<a title="签到二维码" href="javascript:void(0)" class="grid-btn" onclick="oncode(' + rowObject.id + ');"><i class="icon icon-qrcode"></i><div hidden id="code_' + rowObject.id + '" style="position:relative;top:0;"><img src="' + rowObject.qrcode + '" /></div> </a>';
                    }
                    if (rowObject.is_check == 0) {
                        response += '<a title="发布" href="javascript:void(0)" class="grid-btn release" onclick="release(' + rowObject.id + ')"><i class="icon icon-check"></i></a>';
                        response += '<a title="未通过审核" href="javascript:void(0)" class="grid-btn unrelease" onclick="unrelease(' + rowObject.id + ')"><i class="icon icon-times"></i></a>';
                    }
                    return response;
                }
                
                function oncode(id){
                    var activity_id = '#code_'+id;
                    if($(activity_id).hasClass('active'))
                    {
                        $(activity_id).hide();
                        $(activity_id).removeClass('active');
                    }
                    else
                    {
                        $(activity_id).show();
                        $(activity_id).addClass('active');
                    }
                }
                
                function istop(id) {
                    layer.confirm('确定置顶？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activity/top/' + id,
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
                            url: '/admin/activity/untop/' + id,
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

                function release(id) {
                    layer.confirm('确定发布？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: '',
                            dataType: 'json',
                            url: '/admin/activity/release/' + id,
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

                function unrelease(id) {
                    //需要引入layer.ext.js文件
                    layer.prompt({
                        title: '请输入审核不通过的理由',
                        btn: ['确认', '取消'], //按钮
                        formType: 0, // input.type 0:text,1:password,2:textarea
                    }, function (pass) {
                        var msg = {};
                        msg.reason = pass;
                        $.ajax({
                            type: 'post',
                            data: msg,
                            dataType: 'json',
                            url: '/admin/activity/unrelease/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.msg(res.msg);
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2000);
                                }
                            }
                        });
                    }, function () {
                    });
                }

                // 标签
                function industryFormatter(cellvalue, options, rowObject) {
                    var industries = rowObject.industries;
                    response = '';
                    for (i = 0; i < industries.length; i++)
                    {
                        response += '<span style="background:#8AE7F8;margin-right:5px;">' + industries[i].name + '</span>';
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
                            url: '/admin/activity/delete',
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
                    $("body").append("<iframe src='/admin/activity/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/activity/view/' + id;
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
