<script src="/wpadmin/js/jquery.js"></script>
<script src="/wpadmin/lib/layer/layer.js"></script>
<script src="/wpadmin/lib/layer/extend/layer.ext.js"></script>
<link href="/wpadmin/lib/zui/css/zui.min.css" rel="stylesheet">
<link href="/wpadmin/lib/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
<link href="/wpadmin/css/base.css" rel="stylesheet">
<div class="work-copy">
    <form action="" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-8"></div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">标签</label>
            <div class="col-md-8"><input value="<?= $content->name ?>" class="form-control" readonly></div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">推送标题</label>
            <div class="col-md-8"><input type="text" name="title" class="form-control"/></div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">推送内容</label>
            <div class="col-md-8"><textarea name="content" class="form-control"></textarea></div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">推送链接（可选）</label>
            <div class="col-md-8"><input type="text" name="url" class="form-control"/></div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">备注（记录用）</label>
            <div class="col-md-8"><input type="text" name="remark" class="form-control"/></div>
        </div>
        <input type="hidden" name="industry_id" value=""/>
        <!--<input type="hidden" name="type" value=""/>-->
        <!--<input type="hidden" name="activity_id" value=""/>-->
        <input type="hidden" name="keyword" value=""/>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type='submit' id='push' class='btn btn-primary' value='保存' data-loading='稍候...' /> 
            </div>
        </div>
    </form>
</div>
<script src="/wpadmin/js/jquery.js"></script>
<!-- ZUI Javascript组件 -->
<script src="/wpadmin/lib/zui/js/zui.min.plus.js"></script>
<script src="/wpadmin/lib/datetimepicker/jquery.datetimepicker.js"></script>
<script src="/wpadmin/js/global.js"></script>
<script>
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    $('#push').on('click', function () {
        $('input[name="keyword"]').val(parent.$('input[name="keyword"]').val());
//        $('input[name="type"]').val(parent.$('#cate').val());
//        if ($('input[name="type"]').val() == 1) {
//            $('input[name="activity_id"]').val(parent.$('#select-activity').val());
//        } else if ($('input[name="type"]').val() == 2) {
            $('input[name="industry_id"]').val(parent.$('#select-industry').val());
//        }
        if ($('input[name="title"]').val() == '') {
            layer.alert('请输入推送标题');
            return;
        }
        if ($('input[name="content"]').val() == '') {
            layer.alert('请输入推送内容');
            return;
        }
        if ($('input[name="remark"]').val() == '') {
            layer.alert('请输入备注内容');
            return;
        }
        var form = $('form').serialize();
        console.log(form);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: form,
            url: "/admin/push/do_push",
            success: function (res) {
                layer.alert(res.msg);
                if (res.status) {
                    parent.layer.alert('推送成功');
                } else {
                    parent.layer.alert('推送失败');
                }
                parent.layer.close(index);
            }
        });

    });
</script>