<select name="activity_recommends[_ids][]" id="select-activity" class=" form-control" multiple="multiple">
    <?php foreach ($activities as $activity): ?>
        <option></option>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($activity->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $activity->id ?>"><?= $activity->title ?>
        </option>
    <?php endforeach; ?>
</select>