<select name="savant_id" id="select-biggie" class=" form-control">
    <?php foreach ($biggies as $biggie): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($biggie->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $biggie->id ?>"><?= $biggie->user->truename ?> / <?=$biggie->user->company?> / <?=$biggie->user->position?>
        </option>
    <?php endforeach; ?>
</select>