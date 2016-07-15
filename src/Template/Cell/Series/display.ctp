<select name="series_id" id="select-series" class=" form-control">
    <?php foreach ($items as $key=>$item): ?>
        <option <?php if (isset($selIds)): ?>
                <?php if ($key==$selIds): ?>selected="selected"<?php endif; ?>
            <?php endif; ?> 
            value="<?= $key ?>"><?= $item ?>
        </option>
    <?php endforeach; ?>
</select>