<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/course/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="标题">
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
<script>
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
                        url: "/admin/course/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['标题', '培训费用', '状态', '报名人数', '创建时间', '更新时间', '操作'],
                        colModel: [
                            {name: 'title', editable: true, align: 'center'},
                            {name: 'fee', editable: true, align: 'center'},
//                            {name: 'bonus_fee', editable: true, align: 'center'},
//                            {name: 'bonus_start_time', editable: true, align: 'center', formatter: function(cellvalue, options, rowObject) {
//                                    return rowObject.bonus_start_time + '到' + rowObject.bonus_end_time;
//                                }},
                            {name: 'is_online', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    var s;
                                    switch (cellvalue) {
                                        case 1:
                                            s = '<button onClick="online(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-check-circle"></i> 上线</button>';
                                            break;
                                        case 0:
                                            s = '<button onClick="online(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-remove-circle"></i><i style="color:red"> 下线</i></button>';
                                            break;
                                    }
                                    if (rowObject.is_top) {
                                        s += '<span class="notice">(置顶)<span>';
                                    }
                                    return s;
                                }},
                            {name: 'pay_nums', editable: true, align: 'center', formatter: function(cell, opt, row){
                                    return '<a href="/admin/course-apply/index/'+row.id+'">'+cell+'</a>';
                            }},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'update_time', editable: true, align: 'center'},
                            {name: 'actionBtn', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
                        pager: "#pager",
                        rowNum: 10,
                        rowList: [10, 20, 30],
                        sortname: "is_recom",
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
                        loadComplete: function (data) {
                            var clip = '';
                            clip = new ZeroClipboard($('.copy'));
                            console.log('可以复制了');
                            clip.on('copy', function (event) {
                                clip.setData('text/plain', '/course/detail/' + event.target.id);
                            });
                            clip.on("aftercopy", function (event) {
                                layer.msg("复制了: " + event.data["text/plain"]);
                            });
                        },
                    }).navGrid('#pager', {edit: false, add: false, del: false, view: true});
                });

                function actionFormatter(cellvalue, options, rowObject) {
                    response = '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-eye-open"></i> </a>';
                    response += '<a title="课程" href="/admin/class/index/'+rowObject.id+'" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-book"></i> </a>';
                    response += '<a title="编辑" href="/admin/course/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    response += '<a title="复制链接" data-id="' + rowObject.id + '" class="grid-btn copy" id="' + rowObject.id + '"><i class="icon icon-link"></i> </a>';
                    if(rowObject.is_recom){
                        response += '<a title="取消推荐" onclick="recom('+rowObject.id+')" href="javascript:void(0)" class="grid-btn "><i class="icon icon-thumbs-o-down"></i> </a>';
                    } else {
                        response += '<a title="推荐" onclick="recom('+rowObject.id+')" href="javascript:void(0)" class="grid-btn "><i class="icon icon-thumbs-o-up"></i> </a>';
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
                            url: '/admin/course/delete',
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
                    $("body").append("<iframe src='/admin/course/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/course/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['45%', '70%'],
                        content: url//iframe的url
                    });
                }
                
                function online(id){
                    layer.confirm('确定更改上下线？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/course/online',
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
                
                function recom(id){
                    layer.confirm('确定更改推荐状态？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/course/recom',
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
