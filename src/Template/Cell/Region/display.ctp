<select name="region_id" id="select-region" class=" form-control">
    <option value="">请选择</option>
    <?php foreach ($items as $key=>$item): ?>
        <option <?php if (isset($selId)): ?>
                <?php if ($key== $selId): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $key ?>"><?= $item ?>
        </option>
    <?php endforeach; ?>
</select>