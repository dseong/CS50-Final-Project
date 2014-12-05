<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached via GET, passing in necessary variables
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // make sure user is logged in
        if (!empty($_SESSION["id"]))
        {
            // retrieve necessary variables to fill form text boxes
            $name = query("SELECT name FROM groups WHERE id = ?", $_GET["id"])[0]["name"];
            $description = query("SELECT description FROM groups WHERE id = ?", $_GET["id"])[0]["description"];
            
            $genres = [];
            
            $data = query("SELECT * FROM genres");
            
            foreach($data as $datum)
            {
                $genres[] = $datum["name"];
            }
            
            render("edit_group_form.php", ["name" => $name, "description" => $description, "genres" => $genres, "id" => $_GET["id"]]);
        }
        
        // else render login form
        else
            render("login_form.php", ["title" => "Log In"]);
    }
    
    // if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["name"]))
        {
            apologize("You didn't enter a group name");
        }
        // attempt to update info
        if (query("UPDATE groups SET name = ?, genre = ?, description = ?, skill = ? WHERE id = ?", $_POST["name"], $_POST["genre"], $_POST["description"], $_POST["skill"], $_POST["id"]) === false)
            apologize("Unable to modify group information");
        
        // render succes form
        else
            redirect("profile.php");
    } 

?>
