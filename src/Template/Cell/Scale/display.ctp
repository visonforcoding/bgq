<select name="scale_id" id="select-scale" class=" form-control">
    <?php if($selId=='hasAll'): ?>
        <option value="0">全部</option>
    <?php endif; ?>
    <?php foreach ($items as $key=>$item): ?>
        <option <?php if (isset($selId)): ?>
                <?php if ($key== $selId): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $key ?>"><?= $item ?>
        </option>
    <?php endforeach; ?>
</select>