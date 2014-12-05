<?php

    // Include configuration
    require("../includes/config.php");
    
    // gets user id to identify which user's instruments to delete
    $userid = $_SESSION["id"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // Delete user's instrument
        $user = query("UPDATE groupinsts SET userid=NULL WHERE id = ? AND groupid IN (SELECT id FROM groups WHERE ownerid=?)", $_GET["id"], $userid);
        redirect("group.php?id=".$_GET["groupid"]);
        exit;
    }
    
    apologize("An error occurred while removing the user.");
?>
