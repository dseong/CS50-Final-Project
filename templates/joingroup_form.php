<?php if(empty($freeinstruments)): ?>
    <span class="text-warning">You do not play any instruments for this group.</span><br/><br/>
    <a class="btn btn-primary" <?php echo("href=\"group.php?id=".htmlspecialchars($groupid)."\""); ?>>Return to group page</a>
<?php else: ?>
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
<?php endif; ?>
