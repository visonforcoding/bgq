<select name="biggies[_ids]" id="select-biggie" class=" form-control">
    <?php foreach ($biggies as $biggie): ?>
        <option <?php if(isset($selIds)): ?>
            <?php if (in_array($biggie->id, $selIds)): ?>selected="selected"<?php endif; ?>
                <?php endif;?> 
                  value="<?= $biggie->id ?>"><?= $biggie->user->truename ?>
        </option>
    <?php endforeach; ?>
</select>