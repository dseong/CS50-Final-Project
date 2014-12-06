<div>
    <h3> Pending Applications for Group: <?= htmlspecialchars($name) ?> </h3>
    <table class= "table"> 
        <thead>
            <tr>
            <td>Username</td>
            <td>Instrument</td>
            <td>Message</td>
            <td>Accept Member</td>
            <td>Decline Application</td>
            </tr>
        </thead>
        <?php foreach($applications as $app): ?>
        <tr>
            <td><?= htmlspecialchars($app["username"]); ?></td>
            <td><?= htmlspecialchars($app["instrument"]); ?></td>
            <td><?= htmlspecialchars($app["message"]); ?></td>
            <td><a class="btn btn-primary btn-xs" href="<?= "/handle_request.php?id=" . $app["id"] . "&groupid=" . $groupid . "&userid=" . $app["userid"] . "&instrument=" . $app["instrument"] . "&choice=1" ?>">Accept</a></td>
            <td><a class="btn btn-danger btn-xs" href="<?= "/handle_request.php?groupid=" . $groupid . "&choice=0" . "&id=" . $app["id"] ?>">Decline</a></td>
       </tr>
       <?php endforeach; ?>
   </table>
   <a class="btn btn-primary" href="<?= "/group.php?id=".$groupid?>">Return to Group View</a>
</div>
