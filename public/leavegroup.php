<?php

    // configuration
    require("../includes/config.php");
    
    $groupid = $_GET["id"];
    $userid = $_SESSION["id"];

    $query_res = query("UPDATE groupinsts SET userid=NULL WHERE userid=? AND groupid = ?", $userid, $groupid);
    if($query_res === false)
    {
        apologize("An error occurred while removing you from the group.");
    }
        
    redirect("/group.php?id=".$groupid);
?>
