<div class="datacont">
    <p class="datahead">Your Profile</p>
    <p><span class="datakey">Name: </span> <?= htmlspecialchars($name); ?></p>
    <p><span class="datakey">Email: </span> <?= htmlspecialchars($email); ?></p>
    <a href="/edit_profile.php">Edit Profile</a>
</div>
<div class="datacont">
    <?php if(!empty($instruments)): ?>
        <p class="datahead">Your Instruments</p>
        <?php foreach($instruments as $inst): ?>
            <p><?= htmlspecialchars($inst["instrument"]); ?> <a href="<?= "/delinst.php?id=" . $inst["id"]?>">Delete</a></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <a href="/addinstrument.php">Add Instrument</a>
    
<?php if(!empty($memberships)): ?>
    <div class="datacont">
        <table class="table">
            <thead>
                <td>Group Name</td>
                <td>Group Instrument</td>
            </thead>
            <p class="datahead">Your Group Memberships</p>
            <?php foreach($memberships as $memb): ?>
                <tr>
                    <td><a href="<?= "/group.php?id=".$memb["gid"] ?>"><?= htmlspecialchars($memb["name"]) ?></td>
                    <td><?= htmlspecialchars($memb["instrument"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

<?php if(!empty($owned)): ?>
    <div class="datacont">
        <table class="table">
            <thead>
                <td>Group Name</td>
                <td>Members</td>
            </thead>
            <p class="datahead">Groups You Own</p>
            <?php foreach($owned as $own): ?>
                <tr>
                    <td><a href="<?= "/group.php?id=".$own["id"] ?>"><?= htmlspecialchars($own["name"]) ?></td>
                    <td><?= htmlspecialchars($own["fullslot"]."/".$own["slotcnt"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
</div>
