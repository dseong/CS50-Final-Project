<?php
/*
// allows owner or member of a group to leave the group
*/
    // configuration
    require("../includes/config.php");
    
    // gets ids needed
    $groupid = $_GET["id"];
    $userid = $_SESSION["id"];
    
    // leaves group and sets ids equal to null but leaves instrument intact so that the slot remains intact for new member
    $query_res = query("UPDATE groupinsts SET userid=NULL WHERE userid=? AND groupid = ?", $userid, $groupid);
    if($query_res === false)
    {
        apologize("An error occurred while removing you from the group.");
    }
        
    redirect("/group.php?id=".$groupid);
?>
