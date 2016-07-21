<select name="job_id" id="select-job" class=" form-control">
    <?php foreach ($items as $item): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($item->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $item->id ?>"><?= $item->company ?> / <?=$item->position?>
        </option>
    <?php endforeach; ?>
</select>