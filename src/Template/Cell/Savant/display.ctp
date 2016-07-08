<select name="savants[_ids][]" id="select-savant" class=" form-control" multiple="multiple">
    <?php foreach ($savants as $savant): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($savant->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $savant->id ?>"><?= $savant->user->truename ?>
        </option>
    <?php endforeach; ?>
</select>