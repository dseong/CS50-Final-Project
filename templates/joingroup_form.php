<form action="joingroup.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="instrument">
                <?php foreach($freeinstruments as $inst): ?>
                    <option value="<?= htmlspecialchars($inst) ?>"><?= htmlspecialchars($inst) ?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <textarea name="message" rows="3" cols="25"></textarea>
            <input type="hidden" name="groupid" value="<?= $groupid ?>"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Send Request</button>
        </div>
    </fieldset>
</form>
