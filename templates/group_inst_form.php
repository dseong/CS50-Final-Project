<!--form for adding instrument when creating a group-->
<form action="group_instruments.php" method="post">
    <fieldset>
        <?php for($i = 0; $i < $number; $i++): ?>
        <div class="form-group">
            <select class="form-control" name="<?= htmlspecialchars($i) ?>">
                <?php foreach($instruments as $inst): ?>
                    <option value="<?= htmlspecialchars($inst) ?>"><?= htmlspecialchars($inst) ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <?php endfor; ?>
        <div class="form-group">
            <input type = "hidden" name="id" value = "<?= htmlspecialchars($id) ?>"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Add</button>
        </div>
    </fieldset>
</form>
