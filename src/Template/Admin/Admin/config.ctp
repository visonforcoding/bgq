<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <form action="" method="post">
        <table class="table table-hover table-striped table-bordered table-form"> 
            <thead>
                <tr>
                    <th>模块</th>
                    <th>方法</th>
                    <th>模块</th>
                    <th>方法</th>
                    <th>模块</th>
                    <th>方法</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $key => $menu): ?>
                    <?php $key++ ?>
                    <?php if ($key % 3 == 1): ?>
                        <tr>
                        <?php endif; ?>
                        <th class="text-right w150"><?= $menu->name ?><input class="ml5" type="checkbox" value="<?=$menu->id?>" name="menus[_ids][]" 
                               <?php if (in_array($menu->id, $selMenuIds)): ?>checked="true"<?php endif; ?> onclick="selectAll(this,'next')"></th>
                        <td class="col-md-3">
                            <?php if ($menu->children): ?>
                                <?php foreach ($menu->children as $sub_menu): ?>
                                    <div class="group-item">
                                        <input type="checkbox" name="menus[_ids][]" value="<?= $sub_menu->id ?>" 
                                               <?php if (in_array($sub_menu->id, $selMenuIds)): ?>checked="true"<?php endif; ?>>
                                        <span class="priv" id="index-index"><?= $sub_menu->name ?></span>
                                    </div>
                                    <?php if ($sub_menu->children): ?>
                                        <?php foreach ($sub_menu->children as $m): ?>
                                            <div class="group-item ml20">
                                                <input type="checkbox" name="menus[_ids][]" value="<?= $m->id ?>" 
                                                       <?php if (in_array($m->id, $selMenuIds)): ?>checked="true"<?php endif; ?>>
                                                <span class="priv" id="index-index"><?= $m->name ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <?php if ($key % 3 == 0): ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                    <th class="text-right w150">全选<input class="ml5" type="checkbox" name="allchecker[]" onclick="selectAll(this,'all')"></th>
                    <td>
                        <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' /> 
                    </td>
                </tr>
        </table>
    </form>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript" src="/wpadmin/lib/jqform/jquery.form.js"></script>
<script>
                        $(function () {
                            $('form').submit(function () {
                                var form = $(this);
                                $.ajax({
                                    type: $(form).attr('method'),
                                    url: $(form).attr('action'),
                                    data: $(form).serialize(),
                                    dataType: 'json',
                                    success: function (res) {
                                        if (typeof res === 'object') {
                                            if (res.status) {
                                                layer.confirm(res.msg, {
                                                    btn: ['确认', '继续添加'] //按钮
                                                }, function () {
                                                    window.location.href = '/admin/admin/index';
                                                }, function () {
                                                    window.location.reload();
                                                });
                                            } else {
                                                layer.alert(res.msg, {icon: 5});
                                            }
                                        }
                                    }
                                });
                                return false;
                            });
                        });
                        function selectAll(param,type){
                            if(type == 'next'){
                                var td = $(param).parents('th').next('td');
                                if(param.checked){
                                    td.find('input').prop('checked',true);
                                }else{
                                    td.find('input').prop('checked',false);
                                }
                            }
                            if(type == 'all'){
                                if(param.checked){
                                    $('form').find('input').prop('checked',true);
                                }else{
                                    $('form').find('input').prop('checked',false);
                                }
                            }
                        }
</script>
<?php
$this->end();
