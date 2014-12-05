<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached via GET, passing in necessary variables
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // make sure user is logged in
        if (!empty($_SESSION["id"]))
        {
            render("group_form.php");
        }
        
        // else render login form
        else
            render("login_form.php", ["title" => "Log In"]);
    }
    
    // if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // description is allowed to be empty, while the dropdown menu for skill has a default selection, but all other form elements are checked
        if (empty($_POST["name"]))
        {
            apologize("You didn't enter a group name");
        }
        else if (empty($_POST["genre"]))
        {
            apologize("You didn't enter a musical genre");
        }
        else if (empty($_POST["number"]))
        {
            apologize("You didn't enter a number of instruments");
        }
        else if (!preg_match("/^\d+$/", $_POST["number"]))
        {
            apologize("Invalid number of instruments");
        }
        
        // attempt to create group
        if(query("INSERT INTO groups (ownerid, name, genre, description, skill) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], $_POST["name"], $_POST["genre"], $_POST["description"], $_POST["skill"]) === false)
            apologize("Group could not be created");
        // render succes form
        else
        {
            // get group's id
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $instruments = ["Violin", "Viola", "Cello", "Piano", "Base"];
            render("group_inst_form.php", ["number" => $_POST["number"], "id" => $id, "instruments" => $instruments, "title" => "Select Instruments"]);
        }
    } 

?>
