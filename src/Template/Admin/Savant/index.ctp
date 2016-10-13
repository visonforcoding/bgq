<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/lightbox/css/lightbox-rotate.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/savant/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="用户名、手机号、公司">
            </div>
            <div class="form-group">
                <label for="keywords">状态</label>
                <select class="form-control" name="savant_status">
                    <option value="-1">全部</option>
                    <option value="2" <?php if (isset($do)): ?>selected="selected"<?php endif; ?>>未审核</option>
                    <option value="3">审核通过</option>
                    <option value="0">审核未通过</option>
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
<!--查看大图-->
<script src="/wpadmin/lib/jqueryrotate.js"></script>
<script src="/wpadmin/lib/lightbox/js/lightbox-rotate.js"></script>
<script>
                $(function () {
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/savant/getDataList<?php if (isset($do)): ?>?do=check<?php endif; ?>",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['ID', '用户', '手机号', '公司', '职位', '等级', '约见次数', '推荐次数', '项目经验', '资源优势', '审核情况', '置顶', '操作'],
                        colModel: [
                            {name: 'id', editable: true, align: 'center', width:'40px'},
                            {name: 'truename', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    return '<a title="查看" onClick="showSavant(' + " ' " + rowObject.id + " ' " + ');" class="grid-btn ">' + cellvalue + '</a>';
                                }},
                            {name: 'phone', editable: true, align: 'center', width:'100px'},
                            {name: 'company', editable: true, align: 'center'},
                            {name: 'position', editable: true, align: 'center'},
                            {name: 'grade', editable: true, align: 'center', formatter: function (cell, opt, row) {
                                    switch (cell) {
                                        case 1:
                                            return '普通';
                                        case 2:
                                            return '高级';
                                        case 3:
                                            return 'vip';
                                    }
                                }},
                            {name: 'meet_nums', editable: true, align: 'center'},
                            {name: 'savant.reco_nums', editable: true, align: 'center'},
//                            {name: 'cover', editable: true, align: 'center'},
                            {name: 'savant.xmjy', editable: true, align: 'left', formatter: function (cell, opt, row) {
                                    if(!cell)return'';
                                    if (cell.length > 15) {
                                        return cell.substr(0, 15) + '<a class="grid-popover" onclick="showTips(this)" data-content="' + cell + '">[查看更多]<a>';
                                    } else {
                                        return cell;
                                    }
                                }},
                            {name: 'savant.zyys', editable: true, align: 'left', formatter: function (cell, opt, row) {
                                    if(!cell)return'';
                                    if (cell.length > 15) {
                                        return cell.substr(0, 15) + '<a class="grid-popover" onclick="showTips(this)" data-content="' + cell + '">[查看更多]<a>';
                                    } else {
                                        return cell;
                                    }
                                }},
                            {name: 'savant_status', editable: true, align: 'center', formatter: statusFormatter},
                            {name: 'is_top', editable: true, align: 'center', formatter: function (cell, opt, row) {
                                    if (cell == 1) {
                                        return '<span class="notice">已置顶</span>'
                                    } else {
                                        return '<span>未置顶</span>';
                                    }
                                }},
                            {name: 'actionBtn', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
                        pager: "#pager",
                        rowNum: window._config.showDef,
                        rowList: window._config.pages,
                        sortname: "savant.check_time",
                        sortorder: "desc",
                        viewrecords: true,
                        gridview: true,
                        autoencode: true,
                        caption: '',
                        autowidth: true,
                        height: 'auto',
                        rownumbers: false,
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
                function showTips(em) {
                    var content = $(em).data('content');
                    layer.tips(content, em, {
                        tips: [1, '#3595CC'],
                        time: 0,
                        closeBtn: 2
                    });
                }
                function statusFormatter(cellvalue, options, rowObject) {
                    if (rowObject.savant_status == 0) {
                        response = '未通过审核';
                    } else if (rowObject.savant_status == 1) {
                        response = '未认证';
                    } else if (rowObject.savant_status == 2) {
                        response = '待审核';
                    } else if (rowObject.savant_status == 3) {
                        response = '已通过审核';
                    }
                    return response;
                }

                function actionFormatter(cellvalue, options, rowObject) {
                    response = ''; // '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response += '<a title="查看话题" href="/admin/savant/show-subject/' + rowObject.id + '" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-chat-line"></i> </a>';
                    response += '<a title="编辑" href="/admin/savant/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    response += '<a title="查看名片" href="' + rowObject.card_path + '" data-lightbox="' + rowObject.id + '" data-title="' + rowObject.truename + '"><i class="icon icon-picture"></i> </a>';
                    response += '<a title="申请记录" onclick="showApply(' + rowObject.id + ')" class="grid-btn "><i class="icon icon-list-alt"></i> </a>';
                    if (rowObject.is_top == 0) {
                        response += '<a title="置顶" href="javascript:void(0)" class="grid-btn top" onclick="istop(' + rowObject.id + ')"><i class="icon icon-long-arrow-up"></i> </a>';
                    } else {
                        response += '<a title="取消置顶" href="javascript:void(0)" class="grid-btn top" onclick="istop(' + rowObject.id + ')"><i class="icon icon-long-arrow-down"></i> </a>';
                    }
                    if (rowObject.savant_status == 2 || rowObject.savant_status == 0) {
                        response += '<a title="审核通过" href="javascript:void(0)" class="grid-btn release" onclick="pass(' + rowObject.id + ')"><i class="icon icon-check"></i></a>';
                    }
                    if (rowObject.savant_status != 0) {
                        response += '<a title="审核不通过" href="javascript:void(0)" class="grid-btn unrelease" onclick="unpass(' + rowObject.id + ')"><i class="icon icon-times"></i></a>';
                    }
                    return response;
                }

                function pass(id) {
                    layer.confirm('确定通过审核？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/savant/pass/' + id,
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
                function istop(id) {
                    layer.confirm('确定此操作？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/savant/top/' + id,
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

                function unpass(id) {
                    //需要引入layer.ext.js文件
                    layer.prompt({
                        title: '请输入审核不通过的理由',
                        btn: ['确认', '取消'], //按钮
                        formType: 2, // input.type 0:text,1:password,2:textarea
                    }, function (pass) {
                        var msg = {};
                        msg.reason = pass;
                        $.ajax({
                            type: 'post',
                            data: msg,
                            dataType: 'json',
                            url: '/admin/savant/unpass/' + id,
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

                function delRecord(id) {
                    layer.confirm('确定删除？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/savant/delete',
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
                    $("body").append("<iframe src='/admin/savant/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/savant/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['380px', '70%'],
                        content: url//iframe的url
                    });
                }
                function showSavant(id) {
                    url = '/mobile/user/home-page/' + id;
                    layer.open({
                        type: 2,
                        title: '会员主页',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['375px', '667px'],
                        skin: 'layui-layer-lan', //没有背景色
                        content: url
                    });
                }

                function showApply(id) {
                    url = '/admin/savant/show-apply/' + id;
                    layer.open({
                        type: 2,
                        title: '申请记录',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['50%', '70%'],
                        skin: 'layui-layer-lan', //没有背景色
                        content: url
                    });
                }
</script>
<?php
$this->end();
