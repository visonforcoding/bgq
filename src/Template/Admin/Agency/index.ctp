<div class="panel" >
    <div class="panel-heading">
        业务标签结构
    </div>
    <div class="panel-body" style="height:500px;overflow-x:hidden;overflow-y:scroll">
        <ul class="tree treeview">
            <li><a class="add tree-plus" data-id="0"><i class="icon icon-plus-sign"></i></a></li>
            <?php foreach ($industries as $item): ?>
                <li>
                <?= $item->name ?><a class="add tree-plus" data-id="<?= $item->id ?>"><i class="icon icon-plus-sign"></i></a>
                <a class="edit" data-val="<?= $item->name ?>" data-id="<?= $item->id ?>"><i class="icon icon-pencil"></i></a>
                </li>
                <?php if ($item->children): ?>
                    <ul>
                        <?php foreach ($item->children as $i): ?>
                            <li><?= $i->name ?>
                                <!--<a class="del" data-id="<?= $i->id ?>"><i class="icon icon-trash"></i></a>-->
                                <a class="edit" data-val="<?= $i->name ?>" data-id="<?= $i->id ?>"><i class="icon icon-pencil"></i></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php $this->start('script'); ?>
<script>
    $(function () {
        $('.del').click(function () {
            var id = $(this).data('id');
            layer.confirm('确定删除？', {
                btn: ['确认', '取消'] //按钮
            }, function () {
                $.ajax({
                    type: 'post',
                    data: {id: id},
                    dataType: 'json',
                    url: '/admin/agency/delete',
                    success: function (res) {
                        layer.msg(res.msg);
                        if (res.status) {
                            window.location.reload();
                        }
                    }
                })
            }, function () {
            });
        });
        $('.add').click(function () {
            var id = $(this).data('id');
            layer.prompt({
                title: '添加',
                btn: ['确认', '取消'], //按钮
                formType: 0, // input.type 0:text,1:password,2:textarea
            }, function (pass) {
                $.ajax({
                    type: 'post',
                    data: {pid: id, name: pass},
                    dataType: 'json',
                    url: '/admin/agency/add',
                    success: function (res) {
                        layer.msg(res.msg);
                        if (res.status) {
                            window.location.reload();
                        }
                    }
                });
            }, function () {
            });
        });
        $('.edit').click(function () {
            var id = $(this).data('id');
            var val = $(this).data('val');
            layer.prompt({
                title: '修改',
                btn: ['确认', '取消'], //按钮
                formType: 0, // input.type 0:text,1:password,2:textarea
                value:val
            }, function (pass) {
                $.ajax({
                    type: 'post',
                    data: {name: pass},
                    dataType: 'json',
                    url: '/admin/agency/edit/'+id,
                    success: function (res) {
                        layer.msg(res.msg);
                        if (res.status) {
                            window.location.reload();
                        }
                    }
                });
            }, function () {
            });
        });
    });
</script>
<?php $this->end('script'); ?>