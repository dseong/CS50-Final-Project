<?php

    // Include configuration
    require("../includes/config.php");

    $data = [];
    $userid = $_SESSION["id"];
    
    // Get basic user account details
    $user = query("SELECT * FROM users WHERE id=?", $userid);
    // Get user's instrument details
    $instruments = query("SELECT * FROM instruments WHERE userid=?", $userid);
    // Get user's group memberships
    $memberships = query("SELECT G.name, G.id as gid, G.genre, GI.instrument FROM groupinsts AS GI LEFT JOIN groups AS G ON G.id = GI.groupid WHERE GI.userid = ?", $userid);
    // Get groups owned by user (these could be different things)
    $owned = query("SELECT G.id, G.name, (SELECT COUNT(id) FROM groupinsts WHERE groupid=G.id) as slotcnt, (SELECT COUNT(id) FROM groupinsts WHERE groupid=G.id AND userid IS NOT NULL) as fullslot FROM groups AS G WHERE ownerid=?", $userid);
    
    if($user === false || $instruments === false || $memberships === false || $owned === false)
    {
        // Database error
        apologize("An error occurred while fetching your account details.");
    }
    
    // Store out the relevant data for the template
    $data["name"]  = $user[0]["name"];
    $data["email"] = $user[0]["email"];
    $data["username"] = $user[0]["username"];
    $data["instruments"] = $instruments;
    $data["memberships"] = $memberships;
    $data["owned"] = $owned;
    $data["title"] = "Profile";
    
    // Render the template for the user
    render("profile_view.php", $data);
?>
