<select name="user_id" id="select-savant" class=" form-control">
    <?php foreach ($savants as $savant): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if ($savant->id ==$selIds): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $savant->id ?>"><?= $savant->truename ?> / <?=$savant->company?>
        </option>
    <?php endforeach; ?>
</select>