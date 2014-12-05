<div>
    <table class= "table"> 
        <thead>
            <tr>
            <?php if($userismember): ?><td>Owner Name</td><?php endif; ?>
            <td>Owner Username</td>
            <?php if($userismember): ?><td>Email</td><?php endif; ?>
            <td>Group Name</td>
            <td>Description</td>
            <td>Genre</td>
            <td>Skill</td>
            </tr>
        </thead>
        <tr>
            <?php if($userismember): ?><td><?= $groupinfo["uname"] ?></td><?php endif; ?>
            <td><?= $groupinfo["username"] ?></td>
            <?php if($userismember): ?><td><?= $groupinfo["email"] ?></td><?php endif; ?>
            <td><?= $groupinfo["gname"] ?></td>
            <td><?= $groupinfo["description"] ?></td>
            <td><?= $groupinfo["genre"] ?></td>
            <td><?= $groupinfo["skill"] ?></td>
       </tr>
   </table>
    
   
    <table class= "table"> 
    <thead>
        <tr>
        <?php if($userismember): ?><td>Member Name</td><?php endif; ?>
        <td>Member Username</td>
        <?php if($userismember): ?><td>Email</td><?php endif; ?>
        <td>Instrument</td>
        <?php if($userisowner): ?><td>Remove Member</td><?php endif; ?>
        </tr>
    </thead>
    <?php foreach ($slots as $slot): ?>
        <tr>
            <?php if($userismember): ?>
                <td><?= $slot["name"] ?></td>
                <?php endif; ?>
            <?php if(is_null($slot["username"])): ?>
                <td><span class="italic"><?= htmlspecialchars("OPEN") ?></span></td>
                <?php else: ?>
                    <td><?= $slot["username"] ?></td>
                <?php endif; ?>
            <?php if($userismember): ?>
                <td><?= $slot["email"] ?></td>
                <?php endif; ?>
            <td><?= $slot["instrument"] ?></td>
            <?php if($userisowner): ?>
                <td><a href="<?= "/removemem.php?id=".$slot["id"]."&groupid=".$slot["groupid"] ?>">Remove</a></td>
                <?php endif; ?>
       </tr>
    <?php endforeach ?>
        </table>
        <div><a href="<?= "/joingroup.php?id=".$groupid?>">Join</a></div>
    
</div>
