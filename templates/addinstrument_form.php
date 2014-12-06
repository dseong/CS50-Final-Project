<h3>Choose Your Instrument</h3>
<form action="addinstrument.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="instrument">
                <?php foreach($instruments as $inst): ?>
                    <option value="<?= htmlspecialchars($inst) ?>"><?= htmlspecialchars($inst) ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Add</button>
        </div>
    </fieldset>
</form>
