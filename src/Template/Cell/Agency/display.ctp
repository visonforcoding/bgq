<select name="agency_id" id="select-agency" class=" form-control">
    <?php foreach ($agencies as $agency): ?>
        <optgroup label="<?= $agency->name ?>">
            <?php if (!empty($agency->children)): ?>
                <?php foreach ($agency->children as $item): ?>
                <option <?php if(isset($selIds)): ?>
                    <?php if (in_array($item->id, $selIds)): ?>selected="selected"<?php endif; ?>
                        <?php endif;?> 
                          value="<?= $item->id ?>"><?= $item->name ?>
                </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </optgroup>
    <?php endforeach; ?>
</select>