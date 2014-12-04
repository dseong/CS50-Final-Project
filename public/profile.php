<?php

    // Include configuration
    require("../includes/config.php");

    $data = [];
    $userid = $_SESSION["id"];
    
    // Get basic user account details
    $user = query("SELECT * FROM users WHERE id=?", $userid);
    // Get user's instrument details
    $instruments = query("SELECT * FROM instruments WHERE userid=?", $userid);
    
    if($user === false || $instruments === false)
    {
        // Database error
        apologize("An error occurred while fetching your account details.");
    }
    
    // Store out the relevant data for the template
    $data["name"]  = $user[0]["name"];
    $data["email"] = $user[0]["email"];
    $data["instruments"] = $instruments;
    $data["title"] = "Profile";
    
    // Render the template for the user
    render("profile_view.php", $data);
?>
