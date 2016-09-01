<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="用户姓名、内容">
            </div>
            <div class="form-group">
                <label for="keywords">状态</label>
                <select class="form-control" name="status">
                    <option value="">全部</option>
                    <option value="1">已查看</option>
                    <option value="0" <?php if(isset($do)): ?>selected="selected"<?php endif;?>>未查看</option>
                </select>
            </div>
<!--            <div class="form-group">
                <label for="keywords">时间</label>
                <input type="text" name="begin_time" class="form-control date_timepicker_start" id="keywords" placeholder="开始时间">
                <label for="keywords">到</label>
                <input type="text" name="end_time" class="form-control date_timepicker_end" id="keywords" placeholder="结束时间">
            </div>-->
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
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/need/getDataList<?php if(isset($do)): ?>?do=check<?php endif;?>",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['用户', '手机号','公司','职位', '最新消息', '创建时间', '修改时间', '状态', '操作'],
                        colModel: [
                            {name: 'truename', editable: true, align: 'center',sortable: false},
                            {name: 'phone', editable: true, align: 'center',sortable: false},
                            {name: 'company', editable: true, align: 'center',sortable: false},
                            {name: 'position', editable: true, align: 'center',sortable: false},
                            {name: 'msg', editable: true, align: 'center',sortable: false,formatter:function(cell,opt,obj){
                                    return cell.substring(0,10)+'...';
                            }},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'update_time', editable: true, align: 'center',sortable: false},
                            {name: 'status', editable: true, align: 'center',sortable: false, formatter: function (cell, opt, obj) {
                                    if (cell == 1) {
                                        return '已查看';
                                    } else {
                                        return '<span class="notice">未查看</span>';
                                    }
                                }},
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
                            id: "0"
                        },
                    }).navGrid('#pager', {edit: false, add: false, del: false, view: true});
                });

                //function readFormatter(cellvalue, options, rowObject){
                //    if(rowObject.is_read == 0)
                //    {
                //        response = '未读';
                //    }
                //  else if(rowObject.is_read == 1)
                //  {
                //  	response = '已读';
                //  }
                //    return response;
                //}

                function actionFormatter(cellvalue, options, rowObject) {
                    //response += '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response = '<a title="回复"  onClick="doView(' + rowObject.user_id + ');" data-id="' + rowObject.id + '" class="grid-btn"><i class="icon icon-comments-alt"></i> </a>';
                    //response += '<a title="编辑" href="/admin/need/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    return response;
                }

                function reply(id) {
                    //需要引入layer.ext.js文件
                    layer.prompt({
                        title: '请输入回复内容',
                        btn: ['确认', '取消'], //按钮
                        formType: 2, // input.type 0:text,1:password,2:textarea
                    }, function (pass) {
                        var msg = {};
                        msg.reply = pass;
                        $.ajax({
                            type: 'post',
                            data: msg,
                            dataType: 'json',
                            url: '/admin/need/reply/' + id,
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
                            url: '/admin/need/delete',
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
                    $("body").append("<iframe src='/admin/need/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/need/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: false,
                        shade: 0.8,
                        area: ['40%', '60%'],
                        content: url, //iframe的url
                        cancel: function () {
                            $('#list').trigger('reloadGrid');
                        }
                    });
                }
</script>
<?php
$this->end();
