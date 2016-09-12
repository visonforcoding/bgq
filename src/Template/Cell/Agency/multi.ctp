<select name="agency_id[]" id="select-agency"  class="select-agency form-control" multiple="multiple">
    <option></option>
    <?php foreach ($agencies as $agency): ?>
        <optgroup label="<?= $agency->name ?>">
            <?php if (!empty($agency->children)): ?>
                <?php foreach ($agency->children as $item): ?>
                <option <?php if(isset($selId)): ?>
                    <?php if (in_array($item->id,$selId)): ?>selected="selected"<?php endif; ?>
                        <?php endif;?> 
                          value="<?= $item->id ?>"><?= $item->name ?>
                </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </optgroup>
    <?php endforeach; ?>
</select>