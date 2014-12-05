<br>Pending Group Applications<br><br>
<?php foreach($applications as $app): ?>
    Username: <?= htmlspecialchars($app["username"]); ?> <br>
    Instrument: <?= htmlspecialchars($app["instrument"]); ?> <br>
    Group applied to: <?= htmlspecialchars($app["group"]); ?> <br>
    Message: <?= htmlspecialchars($app["message"]); ?> <br><br>
    <a href="<?= "/handle_request.php?id=" . $app["id"] . "&groupid=" . $app["groupid"] . "&userid=" . $app["userid"] . "&instrument=" . $app["instrument"] . "&choice=1" ?>">Add Member</a></p>
    <a href="<?= "/handle_request.php?groupid=" . $app["groupid"] . "&choice=0" . "&id=" . $app["id"] ?>">Decline Request</a></p>
    <br><br>
<?php endforeach; ?>
