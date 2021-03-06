<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/lightbox/css/lightbox-rotate.css">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a href="/admin/user/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="姓名、手机号、email">
            </div>
            <div class="form-group">
                <label for="keywords">等级</label>
                <select name="grade" class="form-control">
                    <option value="">全部</option>
                    <option value="1">普通</option>
                    <option value="2">高级</option>
                    <option value="3">vip</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keywords">状态</label>
                <select name="account_status" class="form-control">
                    <option value="">全部</option>
                    <option value="2">正常</option>
                    <option value="1">禁用</option>
                    <option value="3">删除</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keywords">时间</label>
                <input type="text" name="begin_time" class="form-control date_timepicker_start" id="keywords" placeholder="开始时间">
                <label for="keywords">到</label>
                <input type="text" name="end_time" class="form-control date_timepicker_end" id="keywords" placeholder="结束时间">
            </div>
            <a onclick="doSearch();" class="btn btn-info"><i class="icon icon-search"></i>搜索</a>
            <a onclick="doExport();"   class="btn btn-info"><i class="icon icon-file-excel"></i>导出</a>
        </div>
    </form>
    <table id="list"><tr><td></td></tr></table> 
    <div id="pager"></div> 
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/jqgrid/js/jquery.jqGrid.min.js"></script>
<script src="/wpadmin/lib/jqgrid/js/i18n/grid.locale-cn.js"></script>
<script src="/wpadmin/lib/zeroclipboard/dist/ZeroClipboard.js"></script>
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
                        url: "/admin/user/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        cellEdit: false,
                        cellsubmit: 'remote',
                        cellurl: '/admin/user/hand-change',
                        colNames:
                                ['手机号', '姓名', '类型', '等级', '公司', '职位', '性别', '粉丝数', '关注数', '递名片数', '收名片数','注册时间'],
                        colModel: [
                            {name: 'phone', editable: false, align: 'center'},
                            {name: 'truename', editable: false, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    return '<a title="查看" onClick="showUser(' +" ' "+rowObject.id+" ' " + ');" class="grid-btn ">'+cellvalue+'</a>';
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
                            {name: 'fans', editable: true, align: 'center'},
                            {name: 'focus_nums', editable: true, align: 'center'},
                            {name: 'post_card_nums', editable: true, align: 'center'},
                            {name: 'get_card_nums', editable: true, align: 'center'},
                            {name: 'create_time', editable: true, align: 'center'}
                        ],
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
                            id: 'id',
                        },
                        afterSubmitCell: function (serverresponse, rowid, cellname, value, iRow, iCol) {
                            var res = $.parseJSON(serverresponse.responseText);
                            layer.msg(res.msg);
                            if (res.status) {
                                $('#list').trigger('reloadGrid');
                            }
                        }
                    }).navGrid('#pager', {edit: false, add: false, del: false, view: true, search: false});
                });



                function actionFormatter(cellvalue, options, rowObject) {
                    response = '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn"><i class="icon icon-eye-open"></i> </a>';
                    response += '<a title="查看名片" href="' + rowObject.card_path + '" data-lightbox="' + rowObject.id + '" data-title="' + rowObject.truename + '"><i class="icon icon-picture"></i> </a>';
                    response += '<a title="复制个人主页" data-id="' + rowObject.id + '" class="grid-btn copy" id="' + rowObject.id + '"><i class="icon icon-link"></i> </a>';
                    response += '<a title="修改" href="/admin/user/edit/' + rowObject.id + '" class="grid-btn"><i class="icon icon-pencil"></i> </a>';
                    return response;
                }

                var clip = '';
                setTimeout(function () {
                    clip = new ZeroClipboard($('.copy'));
                    console.log('可以复制了');
                    clip.on('copy', function (event) {
                        clip.setData('text/plain', '/user/home-page/' + event.target.id);
                    });
                    clip.on("aftercopy", function (event) {
                        alert("复制了: " + event.data["text/plain"]);
                    });
                }, 1000);

                function delRecord(id) {
                    layer.confirm('确定删除？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/user/delete',
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
                        area: ['60%', '70%'],
                        content: url//iframe的url
                    });
                }

                function showMp(obj) {
                    //查看名片
                    console.log(obj);
                    layer.open({
                        type: 1,
                        title: '会员名片',
                        shadeClose: true,
                        shade: 0.8,
                        skin: 'layui-layer-nobg', //没有背景色
                        area: ['600px', '500px'],
                        content: '<img src=" ' + obj + ' ">'
                    });
                }
                function ableUser(id) {
                    $.ajax({
                        type: 'post',
                        data: {id: id},
                        dataType: 'json',
                        url: '/admin/user/able-user',
                        success: function (res) {
                            layer.msg(res.msg);
                            if (res.status) {
                                $('#list').trigger('reloadGrid');
                            }
                        }
                    })
                }
                function showUser(id) {
                    url = '/mobile/user/home-page/' + id;
                    layer.open({
                        type: 2,
                        title: '个人主页',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['375px', '667px'],
                        skin: 'layui-layer-lan', //没有背景色
                        content: url
                    });
                }
</script>
<?php
$this->end();
