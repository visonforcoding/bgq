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
                <label for="keywords">系列</label>
                <select class="form-control" name="series_id">
                    <option value="0">所有系列</option>
                    <?php foreach ($series as $key => $item): ?>
                        <option value="<?= $key ?>"><?= $item ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="keywords">城市</label>
                <?= $this->cell('Region') ?>
            </div>
            <div class="form-group">
                <label for="status">上线状态</label>
                <select name="status" class="form-control">
                    <option value="">全部</option>
                    <option value="1">上线</option>
                    <option value="0">下线</option>
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
<script src="/wpadmin/lib/zeroclipboard/dist/ZeroClipboard.js"></script>
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
                        url: "/admin/activity/getDataList",
                        datatype: "json",
                        mtype: "POST",
                        colNames: ['发布人', '主办单位', '活动名称', '活动时间', '是否需审核报名', '规模', '城市', '阅读数', '点赞数', '评论数', '付款人数', '报名人数', '报名费用', '状态', '创建时间', '操作'],
                        colModel: [
                            {name: 'user.truename', editable: true, align: 'center'},
                            {name: 'company', editable: true, align: 'center'},
                            {name: 'title', editable: true, align: 'center', formatter: function (cell, opt, row) {
                                    var s = '<a  data-toggle="tooltip" title="'+cell+'" onClick="showActivity(' + " ' " + row.id + " ' " + ');" class="grid-btn ">' + cell + '</a>';
                                    return s;
                                }},
                            {name: 'time', editable: true, align: 'center'},
                            {name: 'must_check', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    if (cellvalue == '1') {
                                        return '是';
                                    } else {
                                        return '否';
                                    }
                                }},
                            {name: 'scale', editable: true, align: 'center'},
                            {name: 'region.name', editable: true, align: 'center'},
                            {name: 'read_nums', editable: true, align: 'center'},
                            {name: 'praise_nums', editable: true, align: 'center', formatter: function (cell, opt, obj) {
                                    return '<a title="点赞详情" href="/admin/activity/view-like/' + obj.id + '?type=0">' + cell + '</a>';
                                }},
                            {name: 'comment_nums', editable: true, align: 'center', formatter: function (cell, opt, obj) {
                                    return '<a title="评论详情" onClick="viewComs(' + obj.id + ')">' + cell + '</a>';
                                }},
                            {name: 'apply_nums', editable: true, align: 'center', formatter: function (cell, opt, obj) {
                                    if (obj.apply_fee > 0) {
                                        return '<a title="报名详情" href="/admin/activityapply/index/' + obj.id + '">' + cell + '</a>';
                                    } else {
                                        return 0;
                                    }
                                }},
                            {name: 'activityapply', editable: true, align: 'center', formatter: function (cell, opt, obj) {
                                    if (cell.length > 0) {
                                        return '<a title="报名详情" href="/admin/activityapply/index/' + obj.id + '">' + cell.length + '</a>';
                                    } else {
                                        return 0;
                                    }
                                }},
                            {name: 'apply_fee', editable: true, align: 'center'},
                            {name: 'status', editable: true, align: 'center', formatter: function (cellvalue, options, rowObject) {
                                    var s;
                                    switch (cellvalue) {
                                        case 1:
                                            s = '<button onClick="ableThis(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-check-circle"></i> 上线</button>';
                                            break;
                                        case 0:
                                            s = '<button onClick="ableThis(' + rowObject.id + ')" class="btn btn-mini"><i class="icon icon-remove-circle"></i><i style="color:red"> 下线</i></button>';
                                            break;
                                    }
                                    if (rowObject.is_top) {
                                        s += '<span class="notice">(置顶)<span>';
                                    }
                                    return s;
                                }},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'actionBtn', width: '200%', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
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
                            id: 'id'
                        },
                        loadComplete: function (data) {
                            var clip = '';
                            clip = new ZeroClipboard($('.copy'));
                            console.log('可以复制了');
                            clip.on('copy', function (event) {
                                clip.setData('text/plain', '<?= $domain ?>' + '/activity/details/' + event.target.id);
                            });
                            clip.on("aftercopy", function (event) {
                                //if(window.copy_index) layer.close(window.copy_index);
                                layer.msg("复制了: " + event.data["text/plain"]);
                            });
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
                    response += '<a title="编辑" href="/admin/activity/edit/' + rowObject.id + '" class="grid-btn "><i class="icon icon-pencil"></i> </a>';
                    response += '<a title="复制链接" onclick="copy('+rowObject.id+')" data-id="' + rowObject.id + '" class="grid-btn copy" id="' + rowObject.id + '"><i class="icon icon-link"></i> </a>';
                    if (rowObject.is_top == 0) {
                        response += '<a title="置顶" href="javascript:void(0)" class="grid-btn top" onclick="istop(' + rowObject.id + ')"><i class="icon icon-long-arrow-up"></i> </a>';
                    } else if (rowObject.is_top == 1) {
                        response += '<a title="取消置顶" href="javascript:void(0)" class="grid-btn untop" onclick="untop(' + rowObject.id + ')"><i class="icon icon-long-arrow-down"></i></a>';
                    }
                    response += '<a title="收藏日志" href="/admin/activity/view-collect/' + rowObject.id + '" class="grid-btn "><i class="icon icon-star"></i> </a>';
                    response += '<a title="赞助详情" href="/admin/sponsor/index/' + rowObject.id + '" class="grid-btn "><i class="icon icon-dollar"></i> </a>';
//                    response += '<a title="签到二维码" href="javascript:void(0)" class="grid-btn" onclick="oncode(' + rowObject.id + ');"><i class="icon icon-qrcode"></i><div hidden id="code_' + rowObject.id + '" style="position:relative;top:0;"><img back_src="/' + rowObject.qrcode + '" /></div> </a>';
                    response += '<a title="签到" href="javascript:void(0)" class="grid-btn" onclick="sign(' + rowObject.id + ');"><i class="icon icon-qrcode"></i> </a>';
                    return response;
                }

                function copy(id){
                    layer.alert("请手动复制: " + '<?= $domain ?>' + '/activity/details/'+id);
                }

                function oncode(id) {
                    var activity_id = '#code_' + id;
                    $(activity_id).find('img').attr('src', $(activity_id).find('img').attr('back_src'));
                    if ($(activity_id).hasClass('active')) {
                        $(activity_id).hide();
                        $(activity_id).removeClass('active');
                    } else {
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
                                layer.msg(res.msg);
                                if (res.status) {
                                    $('#list').trigger('reloadGrid');
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
                                layer.msg(res.msg);
                                if (res.status) {
                                    $('#list').trigger('reloadGrid');
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
                                layer.msg(res.msg);
                                if (res.status) {
                                    $('#list').trigger('reloadGrid');
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
                                layer.msg(res.msg);
                                if (res.status) {
                                    $('#list').trigger('reloadGrid');
                                }
                            }
                        });
                    }, function () {
                    });
                }
                
                function sign(id){
                    layer.prompt({
                        title: '请输入签到码',
                        btn: ['确认', '取消'], //按钮
                        formType: 0, // input.type 0:text,1:password,2:textarea
                    }, function (code) {
                        var msg = {};
                        msg.code = code;
                        $.ajax({
                            type: 'post',
                            data: msg,
                            dataType: 'json',
                            url: '/activity/sign/' + id,
                            success: function (res) {
                                if (res.status) {
                                    layer.open({
                                        type: 2,
                                        title: '查看详情',
                                        shadeClose: true,
                                        shade: 0.8,
                                        area: ['60%', '70%'],
                                        content: '/admin/activity/view-user/' + res.data
                                    });
                                } else {
                                    layer.msg(res.msg);
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
                    url = '/admin/activity/view/' + id + '?from=back';
                    layer.open({
                        type: 2,
                        title: '查看详情',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['380px', '70%'],
                        content: url//iframe的url
                    });
                }

                function viewComs(id) {
                    //查看评论
                    url = '/admin/activity/comments/' + id;
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
                            url: '/admin/activity/able',
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

                function showActivity(id) {
                    url = '/mobile/activity/details/' + id;
                    layer.open({
                        type: 2,
                        title: '活动预览',
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
