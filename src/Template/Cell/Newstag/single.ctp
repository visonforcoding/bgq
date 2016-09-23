<select name="newstag" id="select-newstag" class=" form-control" >
    <option value="0">请选择</option>
    <?php foreach ($tags as $tag): ?>
        <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
    <?php endforeach; ?>
</select>