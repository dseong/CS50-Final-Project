<form action="edit_group.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="name" value= "<?= htmlspecialchars($name) ?>"  type="text"/>
        </div>
        <div class="form-group">
            <select class="form-control" name="genre">
                <?php foreach($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre) ?>"><?= htmlspecialchars($genre) ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" cols = "40" rows = "4"><?= htmlspecialchars($description) ?></textarea>
        </div>
        <div class="form-group">
            <select class="form-control" name="skill">
                <option value="1">Casual</option>
                <option value="2">Intermediate</option>
                <option value="3">Advanced</option>
            </select>
        </div>
        <div class="form-group">
            <input type = "hidden" name="id" value = "<?= htmlspecialchars($id) ?>"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Modify Information</button>
        </div>
    </fieldset>
</form>
