<?php $single = false; ?>
<?php if (isset($selIds)&&isset($selIds[0])): ?>
    <?php if ($selIds[0] == 'single'): ?>
        <?php $single = true; ?>
    <?php endif; ?>
<?php endif; ?>
<select <?php if(!$single): ?>name="activity_recommends[_ids][]" <?php else: ?>name="activity_id"<?php endif; ?> id="select-activity" class=" form-control" <?php if(!$single): ?>multiple="multiple"<?php endif; ?>>
    <?php foreach ($activities as $activity): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($activity->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $activity->id ?>"><?= $activity->title ?>
        </option>
    <?php endforeach; ?>
</select>