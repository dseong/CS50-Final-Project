<div>
    <h3>Group Information</h3>
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
            <?php if($userismember): ?><td><a href = "<?= "mailto:" .$groupinfo["email"] ?>"><?= htmlspecialchars($groupinfo["email"]) ?></a><?php endif; ?>
            <td><?= $groupinfo["gname"] ?></td>
            <td><?= $groupinfo["description"] ?></td>
            <td><?= $groupinfo["genre"] ?></td>
            <td><?= $groupinfo["skill"] ?></td>
       </tr>
   </table>
   <hr/>
    <h3>Group Members</h3>
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
                    <td><span class="italic text-primary"><?= htmlspecialchars("OPEN") ?></span></td>
                    <?php else: ?>
                        <td><?= $slot["username"] ?></td>
                    <?php endif; ?>
                <?php if($userismember): ?>
                    <td><a href = "<?= "mailto:" .$slot["email"] ?>"><?= htmlspecialchars($slot["email"]) ?></a></td>
                    <?php endif; ?>
                <td><?= $slot["instrument"] ?></td>
                <?php if($userisowner): ?>
                    <td><a class="btn btn-default btn-xs" href="<?= "/removemem.php?id=".$slot["id"]."&groupid=".$slot["groupid"] ?>">Remove</a></td>
                    <?php endif; ?>
           </tr>
        <?php endforeach ?>
    </table>
        <hr/>
        <h3>Group Actions</h3>
        <?php if(!$userisrealmember): ?>
            <a class="btn btn-primary" href="<?= "/joingroup.php?id=".$groupid?>">Join</a>
        <?php else: ?>
            <a class="btn btn-warning" href="<?= "/leavegroup.php?id=".$groupid?>">Leave Group</a>
        <?php endif; ?>
        <?php if($userisowner): ?>
            <a class="btn btn-primary" href="<?= "/request_response.php?id=".$groupid?>">View Applications</a>
        <?php endif; ?>
        <?php if($userisowner): ?>
            <a class="btn btn-danger" href="<?= "/deletegroup.php?id=".$groupid?>">Delete Group</a>
        <?php endif; ?>
    
</div>
