<select name="mentor_id" id="select-mentor" class=" form-control">
    <option></option>
    <?php foreach ($mentors as $mentor): ?>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($mentor->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $mentor->id ?>"><?= $mentor->name ?> / <?=$mentor->company?> / <?=$mentor->position?>
        </option>
    <?php endforeach; ?>
</select>