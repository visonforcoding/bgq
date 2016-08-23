<select name="agency_id" id="select-agency" class=" form-control">
    <?php foreach ($agencies as $agency): ?>
    <option>请选择</option>
        <optgroup label="<?= $agency->name ?>">
            <?php if (!empty($agency->children)): ?>
                <?php foreach ($agency->children as $item): ?>
                <option <?php if(isset($selId)): ?>
                    <?php if ($item->id==$selId): ?>selected="selected"<?php endif; ?>
                        <?php endif;?> 
                          value="<?= $item->id ?>"><?= $item->name ?>
                </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </optgroup>
    <?php endforeach; ?>
</select>