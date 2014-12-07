<?php
/*
// allows user to update his/her profile to delete an instrument they had previously selected to indicate they played
*/
    // Include configuration
    require("../includes/config.php");

    $userid = $_SESSION["id"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // Delete user's instrument
        if(query("DELETE FROM instruments WHERE userid=? AND id=?", $userid, $_GET["id"]) === FALSE)
            apologize("An error occurred while deleting the instrument");
        redirect("profile.php");
    }
    
    apologize("An error occurred while deleting the user.");
?>
