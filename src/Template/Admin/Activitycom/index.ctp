<?php $this->start('static') ?>   
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.jqgrid.css">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/jqgrid/css/ui.ace.css">
<style>
    .area{margin:100px auto;width:60%;}
            .floor>div,.floor>div>div,.floor>div>div>div,.floor>div>div>div>div,.floor>div>div>div>div>div,.floor>div>div>div>div>div>div,.floor>div>div>div>div>div>div>div{border:1px #ccc solid;padding:1px;background: #e1e1e1;}
            .inner-wraper{margin-bottom:10px;padding:0 10px;padding-left:40px;}
            .author{margin-top:10px;color:blue;}
            .content{margin-top:10px;color:#333;}
            .floor-num{position:absolute;width:30px;height:15px;background: gray;color:#fff;line-height: 15px;text-align: center;margin-top:10px;}
</style>
<?php $this->end() ?> 

<div class="col-xs-12">
   <!--  <form id="table-bar-form">
        <div class="table-bar form-inline">
            <div class="form-group">
                <label for="keywords">关键字</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="输入评论内容">
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
    <div id="pager"></div>  -->

    <div class="floor area">
        <p class="author"><span>曹麦穗:</span></p>
        <div class="floor">
            <div class="floor">
                <div class="floor">
            <span class="floor-num">1</span>
            <section class="inner-wraper">
                <p class="author"><span>op1qazse4rfvgy7ujm:</span></p>
                <p class="content">领土问题无条件支持！一寸山河一寸血，一步也不能退让！</p>
            </section>
         </div>
            <span class="floor-num">2</span>
            <section class="inner-wraper">
                <p class="author"><span>op1qazse4rfvgy7ujm:</span></p>
                <p class="content">领土问题无条件支持！一寸山河一寸血，一步也不能退让！</p>
            </section>
         </div>
            <span class="floor-num">3</span>
            <section class="inner-wraper">
                <p class="author"><span>op1qazse4rfvgy7ujm:</span></p>
                <p class="content">领土问题无条件支持！一寸山河一寸血，一步也不能退让！</p>
            </section>
         </div>
        
        <p class="content">国家兴亡，匹夫有责。大敌当前，戮力同心，捍卫主权。</p>
    </div>
</div>
<?php $this->start('script'); ?>
<script src="/wpadmin/lib/jqgrid/js/jquery.jqGrid.min.js"></script>
<script src="/wpadmin/lib/jqgrid/js/i18n/grid.locale-cn.js"></script>
<script>
                $(function () {
                    $.ajax({
                        url：'/activitycom/index',
                        datatype: 'json',
                        type: 'post',
                        success: function(res){
                            console.log(res);
                        }
                    })
                    $('#main-content').bind('resize', function () {
                        $("#list").setGridWidth($('#main-content').width() - 40);
                    });
                    $.zui.store.pageClear(); //刷新页面缓存清除
                    $("#list").jqGrid({
                        url: "/admin/activitycom/getDataList/<?= $id ?>",
                        datatype: "json",
                        mtype: "POST",
                        colNames:
                                ['用户', '评论时间', '评论内容', '点赞数', '所属活动', '操作'],
                        colModel: [
                            {name: 'user.truename', editable: true, align: 'center'},
                            {name: 'create_time', editable: true, align: 'center'},
                            {name: 'body', editable: true, align: 'center'},
                            {name: 'praise_nums', editable: true, align: 'center'},
                            {name: 'activity.title', editable: true, align: 'center'},
                            {name: 'actionBtn', width: '200%', align: 'center', viewable: false, sortable: false, formatter: actionFormatter}],
                            pager: "#pager",
                        rowNum: 30,
                        rowList: [10, 30, 50],
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

                function crowdFormatter(cellvalue, options, rowObject) {
                    if(rowObject.is_crowdfunding == 0){
                        response = '否';
                    } else {
                        response = '是';
                    }
                    return response;
                }

                function actionFormatter(cellvalue, options, rowObject) {
                    response = '<a title="回复" onClick="reply(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-reply"></i> </a>';
                    response += '<a title="删除" onClick="delRecord(' + rowObject.id + ');" data-id="' + rowObject.id + '" class="grid-btn "><i class="icon icon-trash"></i> </a>';
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
                            url: '/admin/activitycom/reply/' + id,
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
                            url: '/admin/activitycom/delete',
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
                    $("body").append("<iframe src='/admin/activitycom/exportExcel?" + searchQueryStr + "' style='display: none;' ></iframe>");
                }

                function doView(id) {
                    //查看明细
                    url = '/admin/activitycom/view?id=' + id;
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
