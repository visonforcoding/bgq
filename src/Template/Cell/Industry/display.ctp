<?php $single = false;?>
<?php if(isset($selIds)&&isset($selIds[0])):?>
    <?php if($selIds[0]=='single'): ?>
     <?php $single = true; ?>
    <?php endif;?>
<?php endif;?>
<select name="industries[_ids][]" id="select-industry" class="select-industry form-control" <?php if(!$single): ?>multiple="multiple"<?php endif;?>>
    <option>请选择</option>
    <?php foreach ($industries as $industry): ?>
        <optgroup label="<?= $industry->name ?>">
            <?php if (!empty($industry->children)): ?>
                <?php foreach ($industry->children as $item): ?>
                <option <?php if(isset($selIds)&&!$single): ?>
                    <?php if (in_array($item->id, $selIds)): ?>selected="selected"<?php endif; ?>
                        <?php endif;?> 
                          value="<?= $item->id ?>"><?= $item->name ?>
                </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </optgroup>
    <?php endforeach; ?>
</select>