<select name="grbq[]" id="select-grbq" class=" form-control" multiple="multiple">
    <option value="">请选择</option>
    <?php foreach ($items as $key=>$item): ?>
        <option <?php if (isset($selId)): ?>
                <?php if (in_array($item, $selId)): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $item ?>"><?= $item ?>
        </option>
    <?php endforeach; ?>
</select>