<form action="search.php" method="post">
    <fieldset>
        <div class="form-group">
            <input class="form-control" name="username" placeholder="Owner's Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="members" placeholder="Group Members" type="text"/>
        </div>
        <div class="form-group">
            <select class="form-control" name="instrument">
                <option value="--none--">Open Slot for Instrument</option>
                <?php foreach($instruments as $instrument): ?>
                    <option value="<?= htmlspecialchars($instrument["instrument"]) ?>">
                        <?= htmlspecialchars($instrument["instrument"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="skill">
                <option value="--none--">Group Skill Level</option>
                <?php foreach($skills as $skill): ?>
                    <option value="<?= htmlspecialchars($skill["id"]) ?>">
                        <?= htmlspecialchars($skill["description"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="genre">
                <option value="--none--">Group Genre</option>
                <?php foreach($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre["name"]) ?>">
                        <?= htmlspecialchars($genre["name"]) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </fieldset>
    <input class="btn btn-default" type="submit" value="Search"/>
</form>
