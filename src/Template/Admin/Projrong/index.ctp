<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/projrong/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="输入关键字">
            </div>
            <div class="form-group">
                <label>融资规模</label>
                <?= $this->cell('Scale', ['hasAll']) ?>
            </div>
            <div class="form-group">
                <label>融资阶段</label>
                <?= $this->cell('Stage', ['hasAll']) ?>
            </div>
            <div class="form-group">
                <label>标签</label>
                <?= $this->cell('Industry::news', [['single']]) ?>
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
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<script>
                $(function () {
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/projrong/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                [ '发布人', '公司', '项目名称','标签' ,'融资阶段', '地点', '融资规模', '股份',  '封面', '项目简介', '公司简介', '核心团队', '资料地址', '创建时间', '更新时间', '操作'],
                        colModel: [
                            {name: 'publisher', editable: true, align: 'center'},
                            {name: 'company', editable: true, align: 'center'},
                            {name: 'title', editable: true, align: 'center'},
                            {name: 'industries', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    var industries_arr = [];
                                    $.each(cellvalue, function (i, n) {
                                        industries_arr.push(n.name);
                                    })
                                    return industries_arr.join(',');
                                }},
                            {name: 'stage.name', editable: true, align: 'center'},
                            {name: 'address', editable: true, align: 'center'},
                            {name: 'scale.name', editable: true, align: 'center'},
                            {name: 'stock', editable: true, align: 'center'},
//                            {name: 'read_nums', editable: true, align: 'center'},
//                            {name: 'praise_nums', editable: true, align: 'center'},
//                            {name: 'comment_nums', editable: true, align: 'center'},
                            {name: 'cover', editable: true, align: 'center',formatter:function(cellvalue,options,rowObject){
                                return '<a title="查看" onClick="showCover(' +" ' "+rowObject.cover+" ' " + ');" class="grid-btn "><i class="icon icon-picture"></i></a>';
                            }},
                            {name: 'summary', editable: true, align: 'center'},
                            {name: 'comp_desc', editable: true, align: 'center'},
                            {name: 'team', editable: true, align: 'center'},
                            {name: 'attach', editable: true, align: 'center',formatter:function(cellvalue,options,rowObject){
                                return '<a title="查看"  onClick ="viewAttatch('+" '"+rowObject.id+"'"+' );" class="grid-btn "><i class="icon icon-paper-clip"></i></a>';
                            }},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'update_time', editable: true, align: 'center'},
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

                    $('#select-industry').select2({
                        language: "zh-CN",
                        placeholder: '选择一个标签'
                    });
                });

                function actionFormatter(cellvalue, options, rowObject) {
                    response = ''; // '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-eye-open"></i> </a>';
                    response += '<a title="编辑" href="/admin/projrong/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
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
                            url: '/admin/projrong/delete',
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
                    $("body").append("<iframe src='/admin/projrong/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/projrong/view/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['45%', '70%'],
                        content: url//iframe的url
                    });
                }
                
                function viewAttatch(id) {
                    //查看明细
                    url = '/admin/projrong/view-attach/' + id;
                    layer.open({
                        type: 2,
                        title: '查看附件',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['45%', '70%'],
                        content: url//iframe的url
                    });
                }
                
               function showCover(cover){
                    layer.open({
                        type: 1,
                        title: '封面',
                        shadeClose: true,
                        shade: 0.8,
                        skin: 'layui-layer-nobg', //没有背景色
                        content: '<img src=" '+cover+' ">'
                    });
               }
</script>
<?php
$this->end();
