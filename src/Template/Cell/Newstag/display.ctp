<?php $single = false; ?>
<?php if (isset($selIds) && isset($selIds[0])): ?>
    <?php if ($selIds[0] == 'single'): ?>
        <?php $single = true; ?>
    <?php endif; ?>
<?php endif; ?>
<select name="newstags[_ids][]" id="select-newstag" class=" form-control" <?php if (!$single): ?>multiple="multiple"<?php endif; ?>>
    <?php foreach ($tags as $tag): ?>
        <option <?php if (isset($selIds) && !$single): ?>
                <?php if (in_array($tag->id, $selIds)): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $tag->id ?>"><?= $tag->name ?>
        </option>
    <?php endforeach; ?>
</select>