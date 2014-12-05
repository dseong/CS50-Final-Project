<div>
    <table class= "table"> 
        <thead>
            <tr>
            <td>Owner Name</td>
            <td>Owner Username</td>
            <td>Email</td>
            <td>Group Name</td>
            <td>Description</td>
            <td>Genre</td>
            <td>Skill</td>
            </tr>
        </thead>
        <tr>
            <?php if($userismember): ?><td><?= $groupinfo["name"] ?></td><?php endif; ?>
            <td><?= $groupinfo["username"] ?></td>
            <?php if($userismember): ?><td><?= $groupinfo["email"] ?></td><?php endif; ?>
            <td><?= $groupinfo["name"] ?></td>
            <td><?= $groupinfo["description"] ?></td>
            <td><?= $groupinfo["genre"] ?></td>
            <td><?= $groupinfo["skill"] ?></td>
       </tr>
   </table>
    
   
    <table class= "table"> 
    <thead>
        <tr>
        <td>Member Name</td>
        <td>Member Username</td>
        <td>Email</td>
        <td>Instrument</td>
        </tr>
    </thead>
    <?php foreach ($slots as $slot): ?>
        <tr>
            <?php if($userismember): ?><td><?= $slot["name"] ?></td><?php endif; ?>
            <?php if(is_null($slot["username"])): ?><td><span class="italic"><?= htmlspecialchars("OPEN") ?></span></td><?php endif; ?>
            <?php if(is_null($slot["username"]===false)): ?><td><?= $slot["username"] ?></td><?php endif; ?>
            <td><?= $slot["username"] ?></td>
            <?php if($userismember): ?><td><?= $slot["email"] ?></td><?php endif; ?>
            <td><?= $slot["instrument"] ?></td>
            
       </tr>
    <?php endforeach ?>
        </table>
    
</div>
