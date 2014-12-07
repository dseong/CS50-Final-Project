<div>
    <!--Group info visible to everyone except name and email which is only available for members of group-->
    <h3>Group Information</h3>
    <table class= "table"> 
        <thead>
            <tr>
                <td>Group Name</td>
                <td>Description</td>
                <td>Genre</td>
                <td>Skill</td>
                <td>Owner Username</td>
                <?php if($userismember): ?><td>Owner Name</td><?php endif; ?>
                <?php if($userismember): ?><td>Email</td><?php endif; ?>
            </tr>
        </thead>
        <tr>
            <td><?= $groupinfo["gname"] ?></td>
            <td><?= $groupinfo["description"] ?></td>
            <td><?= $groupinfo["genre"] ?></td>
            <td><?= $groupinfo["skill"] ?></td>
            <td><?= $groupinfo["username"] ?></td>
            <?php if($userismember): ?><td><?= $groupinfo["uname"] ?></td><?php endif; ?>
            <?php if($userismember): ?><td><a href = "<?= "mailto:" .$groupinfo["email"] ?>"><?= htmlspecialchars($groupinfo["email"]) ?></a><?php endif; ?>
       </tr>
   </table>
   <hr/>
    <h3>Group Members</h3>
    <!--letes everyone view username and instrument of members, but not email or name unless you are a member-->
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
                    <?php if(!is_null($slot["username"])): ?>
                        <td>
                            <a class="btn btn-default btn-xs" href="<?= "/removemem.php?id=".$slot["id"]."&groupid=".$slot["groupid"] ?>">
                                Remove
                            </a>
                        </td>
                        <?php else: ?>
                            <td></td>
                    <?php endif; ?>
                    <?php endif; ?>
           </tr>
        <?php endforeach ?>
    <!--Table of options visible only to owner of group-->
    </table>
        <hr/>
        <h3>Group Actions</h3>
        <?php if(!$commoninst && !$userisrealmember): ?>
            <div>
                <p><span class="text-info">You do not play an instrument needed by this group.</span></p>
                <p><a class="btn btn-primary" href="/profile.php">Edit your profile</a></p>
            </div>
        <?php endif; ?>
        <?php if(!$userisrealmember && $commoninst): ?>
            <a class="btn btn-primary" href="<?= "/joingroup.php?id=".$groupid?>">Join</a>
        <?php elseif($userisrealmember): ?>
            <a class="btn btn-warning" href="<?= "/leavegroup.php?id=".$groupid?>">Leave Group</a>
        <?php endif; ?>
        <?php if($userisowner): ?>
            <a class="btn btn-primary" href="<?= "/request_response.php?id=".$groupid?>">View Applications</a>
        <?php endif; ?>
        <?php if($userisowner): ?>
            <a class="btn btn-primary" href="<?= "/edit_group.php?id=".$groupid?>">Edit Group</a>
        <?php endif; ?>
        <?php if($userisowner): ?>
            <a class="btn btn-danger" href="<?= "/deletegroup.php?id=".$groupid?>">Delete Group</a>
        <?php endif; ?>
    
</div>
