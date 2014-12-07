<div class="row">
    <div class="col-md-3">
        <div id="searchform">
            <form action="search.php" method="get">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control " <?php if(!empty($username))echo("value=\"".$username."\""); ?> name="username" placeholder="Owner's Username" type="text"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control " <?php if(!empty($members))echo("value=\"".$members."\""); ?> name="members" placeholder="Group Members" type="text"/>
                    </div>
                    <div class="form-group">
                        <select class="form-control " name="instrument">
                            <option value="--none--">Open Slot for Instrument</option>
                            <?php foreach($instruments as $instrument): ?>
                                <option <?php if(!empty($selinstrument)&&$selinstrument===$instrument["instrument"])echo("selected"); ?> value="<?= htmlspecialchars($instrument["instrument"]) ?>">
                                    <?= htmlspecialchars($instrument["instrument"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group ">
                        <select class="form-control " name="skill">
                            <option value="--none--">Group Skill Level</option>
                            <?php foreach($skills as $skill): ?>
                                <option <?php if(!empty($selskill)&&$selskill===$skill["id"])echo("selected"); ?> value="<?= htmlspecialchars($skill["id"]) ?>">
                                    <?= htmlspecialchars($skill["description"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="genre">
                            <option value="--none--">Group Genre</option>
                            <?php foreach($genres as $genre): ?>
                                <option <?php if(!empty($selgenre)&&$selgenre===$genre["name"])echo("selected"); ?> value="<?= htmlspecialchars($genre["name"]) ?>">
                                    <?= htmlspecialchars($genre["name"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default form-control" type="hidden" name="search" value="yes"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default form-control" type="submit" value="Search"/>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="col-md-9">
        <?php if($search): ?>
            <h3>Search Results</h3>
                <?php if(!empty($results)): ?>
                <hr/>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Group Name</td>
                            <td>Description</td>
                            <td>Skill</td>
                            <td>Owner</td>
                            <td>Members</td>
                        </tr>
                    </thead>
                    <?php foreach($results as $result): ?>
                        <tr>
                            <td><a <?php echo("href=\"/group.php?id=".htmlspecialchars($result["id"])."\""); ?>><?= htmlspecialchars($result["name"]); ?></a></td>
                            <td><?= htmlspecialchars($result["description"]); ?></td>
                            <td><?= htmlspecialchars($result["skill"]); ?></td>
                            <td><?= htmlspecialchars($result["username"]); ?></td>
                            <td>
                                <?= htmlspecialchars($result["fullslot"]."/".$result["slotcnt"]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <h4>No Results Found</h4>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
