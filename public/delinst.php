<?php

    // Include configuration
    require("../includes/config.php");

    $userid = $_SESSION["id"];
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // Delete user's instrument
        $user = query("DELETE FROM instruments WHERE userid=? AND id=?", $userid, $_GET["id"]);
    }
    
    redirect("profile.php");
?>
