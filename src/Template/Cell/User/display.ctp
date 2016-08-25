<select name="user_id" id="select-user" class=" form-control">
    <option value="0">请选择</option>
    <?php foreach ($users as $user): ?>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($user->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $user->id ?>"><?= $user->truename ?> / <?=$user->company?> / <?=$user->position?>
        </option>
    <?php endforeach; ?>
</select>