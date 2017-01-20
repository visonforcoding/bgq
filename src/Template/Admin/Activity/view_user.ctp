<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
    <style>
        th{
            width:120px;text-align: center;
        }
    </style>
</head>
<body>
<div class="bookChat view large-9 medium-8 columns content">
    <table class="vertical-table table table-hover table-bordered">
        <?php if($apply->other_user): ?>
        <tr>
            <th>头像</th>
            <td><img src="<?= $apply->other_user->avatar ?>" style="width:120px;height:120px;border-radius: 50% 50%;"/></td>
        </tr>
        <?php endif; ?>
        <tr>
            <th>姓名</th>
            <td><?= $apply->name ?></td>
        </tr>
        <tr>
            <th>公司</th>
            <td><?= $apply->company ?></td>
        </tr>
        <tr>
            <th>职位</th>
            <td><?= $apply->position ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type='submit' id='confirm' class='btn btn-primary' value='确认签到' data-loading='稍候...' />
                <input type='submit' id='cancel' class='btn btn-primary' value='取消' data-loading='稍候...' />
            </td>
        </tr>
    </table>
</div>
    <script src="/wpadmin/js/jquery.js"></script>
<script>
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    $('#confirm').on('click', function(){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/admin/activity/sign-confirm/<?= $apply->id ?>",
            success: function (res) {
                parent.layer.alert(res.msg);
                if(res.status){
                    parent.layer.close(index);
                }
            }
        });
    });
    
    $('#cancel').on('click', function (){
        parent.layer.close(index);
    });
</script>
</body>
