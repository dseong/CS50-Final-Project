<?php

    // Include configuration
    require("../includes/config.php");

    $data = [];
    $userid = $_SESSION["id"];
    
    /* Can search by:
        - Group owner (username)
        - Members in group (username)
        - Looking for (instrument)
        - Skill level
        - Genre
    */
    
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        // User submitted the form
        $data["results"] = [];
        
    }
    
    $data["skills"] = query("SELECT * FROM skills");
    $data["instruments"] = query("SELECT * FROM insttypes");
    $data["genres"] = query("SELECT * FROM genres");
    render("search_form.php", $data);
?>
