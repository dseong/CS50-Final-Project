<?php
/*
// allows owner of group to delete his/her own group
*/ 
    // configuration
    require("../includes/config.php");
    
    $groupid = $_GET["id"];
    $userid = $_SESSION["id"];

    // MySQL foreign key cascades will clean up the group instrument slots for us.
    // We just have to delete the group record itself
    $query_res = query("DELETE FROM groups WHERE id=? AND ownerid=?", $groupid, $userid);
    if($query_res === false)
    {
        apologize("An error occurred while deleting your group.");
    }
    // check that user has selected valid group for deletion
    if($query_res === 0)
    {
        apologize("No group was eligible for deletion. Please try again.");
    }
        
    render("groupdelete.php");
?>
