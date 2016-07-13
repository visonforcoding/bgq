<select name="admin_id" id="select-admin" class=" form-control">
    <?php foreach ($admins as $admin): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($admin->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $admin->id ?>"><?= $admin->truename ?> / <?=$admin->username?>
        </option>
    <?php endforeach; ?>
</select>