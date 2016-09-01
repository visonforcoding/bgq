<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="col-xs-12">
    <form id="table-bar-form">
        <div class="table-bar form-inline">
            <a  href="/admin/news/add" class="btn btn-small btn-warning">
                <i class="icon icon-plus-sign"></i>添加
            </a>
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="用户名、标题、摘要">
            </div>
            <div class="form-group">
                <label for="keywords">行业标签</label>
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
<script src="/wpadmin/lib/zeroclipboard/dist/ZeroClipboard.js"></script>
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<script>
                $(function () {
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/news/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['作者', '标题', '行业标签','资讯标签', '阅读数', '点赞数', '评论数', '状态' ,'创建时间', '更新时间', '操作'],
                        colModel: [
                            {name: 'user.truename', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    if (!cellvalue) {
                                        return rowObject.source;
                                    } else {
                                        return rowObject.user.truename;
                                    }
                                }},
                            {name: 'title', editable: true, align: 'center',formatter: function (cellvalue, options, rowObject) {
                                    return '<a  data-toggle="tooltip" title="这是提示消息内容" onClick="showNews(' +" ' "+rowObject.id+" ' " + ');" class="grid-btn ">'+cellvalue+'</a>';
                            }},
                            {name: 'industries', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    var industries_arr = [];
                                    $.each(cellvalue, function (i, n) {
                                        industries_arr.push(n.name);
                                    })
                                    return industries_arr.join(',');
                                }},
                            {name: 'newstags', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    var industries_arr = [];
                                    $.each(cellvalue, function (i, n) {
                                        industries_arr.push(n.name);
                                    })
                                    return industries_arr.join(',');
                                }},
                            {name: 'read_nums', editable: true, align: 'center'},
                            {name: 'praise_nums', editable: true, align: 'center', formatter: function (cell, opt, obj) {
                                    return '<a title="点赞详情" href="/admin/news/view-like/' + obj.id + '?type=1">' + cell + '</a>';
                                }},
                            {name: 'comment_nums', editable: true, align: 'center', formatter: function (cell, opt, obj) {
                                    return '<a title="评论详情" onClick="viewComs(' + obj.id + ')">' + cell + '</a>';
                                }},
                            {name: 'status', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    var s;
                                    switch (cellvalue) {
                                        case 1:
                                            s =  '<button onClick="ableThis(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-check-circle"></i> 上线</button>';
                                            break;
                                        case 0:
                                            s =  '<button onClick="ableThis(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-remove-circle"></i><i style="color:red"> 下线</i></button>';
                                            break;
                                    }
                                    if(rowObject.is_top==1){
                                        s += '<span class="notice">(已置顶)</span>'
                                    }
                                    return s;
                            }},
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

                    $('#select-industry').select2({
                        language: "zh-CN",
                        placeholder: '选择一个标签'
                    });
                });
                function actionFormatter(cellvalue, options, rowObject) {
//                    response = '<div class="bigdiv" onmouseout=$(this).find(".showall").hide();$(this).find(".showallbtn").show(); ><a class="showallbtn" title="操作" onmouseover=$(this).hide();$(this).next(".showall").show();><i class="icon icon-resize-full"></i></a>';
//                    response = '<div class="showall" hidden onmouseover=$(this).show();$(this).prev(".showallbtn").hide(); ><a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
                    response = '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
//                    response += '<a title="查看" onClick="doView(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-eye-open"></i> </a>';
                    response += '<a title="复制" data-id="' + rowObject.id + '" class="grid-btn copy" id="' + rowObject.id + '"><i class="icon icon-link"></i> </a>';
                    response += '<a title="编辑" href="/admin/news/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    if(rowObject.is_top==0){
                        response += '<a title="置顶" href="javascript:void(0)" class="grid-btn top" onclick="topit(' + rowObject.id + ')"><i class="icon icon-long-arrow-up"></i> </a>';
                    }else{
                        response += '<a title="取消置顶" href="javascript:void(0)" class="grid-btn top" onclick="topit(' + rowObject.id + ')"><i class="icon icon-long-arrow-down"></i> </a>';
                    }
//                    response += '<a title="评论详情" onClick="viewComs(' + rowObject.id + ');" class="grid-btn "><i class="icon icon-comment"></i> </a>';
//                    response += '<a title="点赞日志" href="/admin/likeLogs/index/' + rowObject.id + '?type=1" class="grid-btn "><i class="icon icon-heart"></i> </a>';
                    response += '<a title="收藏日志" href="/admin/news/view-collect/' + rowObject.id + '?type=1" class="grid-btn "><i class="icon icon-star"></i> </a>';
//                    response += '</div></div>';
                    return response;
                }

                var clip = '';
                setTimeout(function () {
                    clip = new ZeroClipboard($('.copy'));
                    console.log('可以复制了');
                    clip.on('copy', function (event) {
                        clip.setData('text/plain', '<?=$domain?>'+'/news/view/' + event.target.id);
                    });
                    clip.on("aftercopy", function (event) {
                        layer.msg("复制了: " + event.data["text/plain"]);
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
                            url: '/admin/news/delete',
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
                function topit(id) {
                    layer.confirm('确定进行此操作？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/news/top/'+id,
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
                    var postData = $('#table-bar-form').serialize();
                    postData = decodeURI(postData);
                    $.zui.store.pageSet('searchData', postData); //本地存储查询参数 供导出操作等调用
                    $("#list").jqGrid('setGridParam', {
                        postData: $.global.queryParam2Json(postData)
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
                    $("body").append("<iframe src='/admin/news/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/news/view/' + id+'?from=back';
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['60%', '50%'],
                        content: url//iframe的url
                    });
                }
                function viewComs(id) {
                    //查看评论
                    url = '/admin/news/comments/' + id;
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        maxmin: true, //开启最大化最小化按钮
                        area: ['60%', '50%'],
                        content: url//iframe的url
                    });
                }
                function ableThis(id) {
                    layer.confirm('确定更改上下线？', {
                        btn: ['确认', '取消'] //按钮
                    }, function () {
                        $.ajax({
                            type: 'post',
                            data: {id: id},
                            dataType: 'json',
                            url: '/admin/news/able',
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
                function showNews(id) {
                    url = '/mobile/news/view/' + id;
                    layer.open({
                        type: 2,
                        title: '资讯预览',
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
