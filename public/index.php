<?php
// sends user to homepage when logged in or displays home page if not
    // configuration
    require("../includes/config.php"); 

    if(logged_in())
    {
        redirect("profile.php");
    }
    else
    {
        render("home.php", ["title" => "Home"]);
    }
?>
