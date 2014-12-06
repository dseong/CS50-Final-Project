<?php

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
