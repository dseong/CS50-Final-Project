<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached via GET, passing in necessary variables
    if ($_SERVER["REQUEST_METHOD"] == "GET")
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
        
        render("edit_group_form.php", ["title" => "Edit Group", "name" => $name, "description" => $description, "genres" => $genres, "id" => $_GET["id"]]);
    }
    // if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["name"]))
        {
            apologize("You didn't enter a group name");
        }
        // attempt to update info
        if (query("UPDATE groups SET name = ?, genre = ?, description = ?, skill = ? WHERE id = ? AND ownerid = ?", $_POST["name"], $_POST["genre"], $_POST["description"], $_POST["skill"], $_POST["id"], $_SESSION["id"]) === false)
            apologize("Unable to modify group information");
        
        // render succes form
        else
            redirect("group.php?id=" . htmlspecialchars($_POST["id"]));
    } 

?>
