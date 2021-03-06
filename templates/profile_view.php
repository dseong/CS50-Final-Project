<div class="datacont">
    <h3 class="datahead">Your Profile</h3>
    <span class="datakey">Name: </span> <?= htmlspecialchars($name); ?><br>
    <span class="datakey">Username: </span> <?= htmlspecialchars($username); ?><br>
    <span class="datakey">Email: </span> <a href = "<?= "mailto:" .$email ?>"><?= htmlspecialchars($email) ?></a><br/><br/>
    <a class="btn btn-primary" href="/edit_profile.php">Edit Profile</a>
</div>

<br>
<div class="datacont">
    <?php if(!empty($instruments)): ?>
        <h3 class="datahead">Your Instruments</h3>
        <?php foreach($instruments as $inst): ?>
            <p><b><?= htmlspecialchars($inst["instrument"]); ?></b><span class="space"></span><a class="btn btn-danger btn-xs" href="<?= "/delinst.php?id=" . $inst["id"]?>">Delete</a></p>
        <?php endforeach; ?>
    <?php endif; ?>
    
<a class="btn btn-primary" href="addinstrument.php">Add an Instrument You Play</a>
<br><br>

<?php if(!empty($memberships)): ?>
    <div class="datacont">
        <h3 class="datahead">Your Group Memberships</h3>
        <table class="table">
            <thead>
                <tr>
                    <td>Group Name</td>
                    <td>Group Instrument</td>
                </tr>
            </thead>
            <?php foreach($memberships as $memb): ?>
                <tr>
                    <td><a href="<?= "/group.php?id=".$memb["gid"] ?>"><?= htmlspecialchars($memb["name"]) ?></a></td>
                    <td><?= htmlspecialchars($memb["instrument"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

<?php if(!empty($owned)): ?>
    <div class="datacont">
        <h3 class="datahead">Groups You Own</h3>
        <table class="table">
            <thead>
                <tr>
                    <td>Group Name</td>
                    <td>Members</td>
                </tr>
            </thead>
            <?php foreach($owned as $own): ?>
                <tr>
                    <td><a href="<?= "/group.php?id=".$own["id"] ?>"><?= htmlspecialchars($own["name"]) ?></a></td>
                    <td><?= htmlspecialchars($own["fullslot"]."/".$own["slotcnt"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
</div>
