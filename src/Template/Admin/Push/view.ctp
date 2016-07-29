<script src="/wpadmin/js/jquery.js"></script>
<script src="/wpadmin/lib/layer/layer.js"></script>
<script src="/wpadmin/lib/layer/extend/layer.ext.js"></script>
<div class="activity view large-9 medium-8 columns content">
    <form action="" method="post">
        <table class="vertical-table">
            <tr>
                <th>标题</th>
                <td><input type="text" name="title"/></td>
            </tr>
            <tr>
                <th>内容</th>
                <td><textarea name="content"></textarea></td>
            </tr>
            <tr>
                <th>链接</th>
                <td><input type="text" name="url"/></td>
            </tr>
        </table>
        <!--<input type="hidden" name="choose" value=""/>-->
        <input type="hidden" name="activity_id" value=""/>
        <input type="hidden" name="keyword" value=""/>
    </form>
    <button id="push">推送</button>
</div>
<script>
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    $('#push').on('click', function () {
        $('input[name="activity_id"]').val(parent.$('#select-activity').val());
        $('input[name="keyword"]').val(parent.$('input[name="keyword"]').val());
        if($('input[name="title"]').val() == ''){
            layer.alert('请输入推送标题');
            return;
        }
        if($('input[name="content"]').val() == ''){
            layer.alert('请输入推送内容');
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
