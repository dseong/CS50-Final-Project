<div class="datacont">
    <p class="datahead">Your Profile</p>
    <p><span class="datakey">Name: </span> <?= htmlspecialchars($name); ?></p>
    <p><span class="datakey">Email: </span> <?= htmlspecialchars($email); ?></p>
    <a href="/edit_profile.php">Edit Profile</a>
</div>
<div class="datacont">
    <p class="datahead">Your Instruments</p>
    <?php foreach($instruments as $inst): ?>
        <p><?= htmlspecialchars($inst["instrument"]); ?> <a href="<?= "/delinst.php?id=" . $inst["id"]?>">Delete</a></p>
    <?php endforeach; ?>
    <a href="/addinstrument.php">Add Instrument</a>
</div>
