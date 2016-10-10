<?php $single = false; ?>
<?php if (isset($selIds)&&isset($selIds[0])): ?>
    <?php if ($selIds[0] == 'single'): ?>
        <?php $single = true; ?>
    <?php endif; ?>
<?php endif; ?>
<select name="industry_id" id="select-industry" class=" form-control" <?php if (!$single): ?>multiple="multiple"<?php endif; ?>>
    <option value="all">全部</option>
    <?php foreach ($industries as $industry): ?>
        <option <?php if (isset($selIds) && !$single): ?>
                <?php if (in_array($industry->id, $selIds)): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $industry->id ?>"><?= $industry->name ?>
        </option>
    <?php endforeach; ?>
</select>