<select name="user_id" id="select-user" class=" form-control">
    <?php foreach ($users as $user): ?>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($user->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $user->id ?>"><?= $user->truename ?>
        </option>
    <?php endforeach; ?>
</select>