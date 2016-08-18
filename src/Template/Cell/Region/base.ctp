<select name="city" id="select-region" class=" form-control">
    <option value="">请选择</option>
    <?php foreach ($items as $key=>$item): ?>
        <option <?php if (isset($selId)): ?>
                <?php if ($item== $selId): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $item ?>"><?= $item ?>
        </option>
    <?php endforeach; ?>
</select>