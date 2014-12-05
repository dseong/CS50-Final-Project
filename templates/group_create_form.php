<h3>Please Fill Out the Following Information</h3>
<br/>
<form action="create_group.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="name" placeholder = "Group name"  type="text"/>
        </div>
        Musical genre
        <div class="form-group">
            <select class="form-control" name="genre">
                <?php foreach($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre) ?>"><?= htmlspecialchars($genre) ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" cols = "40" rows = "4">Group Description</textarea>
        </div>
        Your instrument
        <div class="form-group">
            <select class="form-control" name="instrument">
                <?php foreach($instruments as $inst): ?>
                    <option value="<?= htmlspecialchars($inst) ?>"><?= htmlspecialchars($inst) ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <input class="form-control" name="number" placeholder= "Number of other players" type="text"/>
        </div>
        Group Skill level
        <div class="form-group">
            <select class="form-control" name="skill">
                <?php foreach($skills as $skill): ?>
                    <option value="<?= htmlspecialchars($skill["id"]) ?>"><?= htmlspecialchars($skill["description"]) ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Create Group</button>
        </div>
    </fieldset>
</form>
