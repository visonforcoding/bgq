<?php $this->start('static') ?>   
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
                url: "/admin/user/getDataList?type=1",
                datatype: "json",
                mtype: "POST",
                colNames:
                        ['手机号', '姓名', '等级', '身份证','职位',  '性别',  '审核状态', '创建时间',  '操作'],
                colModel: [
                    {name: 'phone', editable: true, align: 'center'},
                    {name: 'truename', editable: true, align: 'center'},
                    {name: 'level', editable: true, align: 'center',formatter(cellvalue, options, rowObject){
                            if(cellvalue=='1'){
                                return '普通';
                            }else{
                                return '会员';
                            }
                    }},
                    {name: 'idcard', editable: true, align: 'center'},
                    {name: 'position', editable: true, align: 'center'},
                    {name: 'gender', editable: true, align: 'center',formatter(cellvalue, options, rowObject){
                            if(cellvalue=='1'){
                                return '男';
                            }else{
                                return '女';
                            }
                    }},
                    {name: 'status', editable: true, align: 'center',cellEdit:true,formatter(cellvalue, options, rowObject){
                            switch(cellvalue)
                            {
                             case 1:
                                return '<i style="color:red">待审核</i>';
                            }
                    }},
                    {name: 'create_time', editable: true, align: 'center'},
                    {name: 'actionBtn',align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
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
            }).navGrid('#pager', {edit: false, add: false, del: false, view: true,search:false});
        });

        function actionFormatter(cellvalue, options, rowObject) {
            response = '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn"><i class="icon icon-eye-open"></i> </a>';
            return response;
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
            $("body").append("<iframe src='/admin/user/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
        }

        function doView(id) {
            //查看明细
            url = '/admin/user/view/' + id;
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
