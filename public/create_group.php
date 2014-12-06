<?php

    // configuration
    require("../includes/config.php");
    
    // array for dropdown menu populated with list of valid instruments from sql table
    $instruments = [];
            
    $data = query("SELECT * FROM insttypes");
            
    foreach($data as $datum)
    {
         $instruments[] = $datum["instrument"];
    }
    
    // if user reached via GET, passing in necessary variables
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // make sure user is logged in
        if (!empty($_SESSION["id"]))
        {
            $genres = [];
            
            $data = query("SELECT * FROM genres");
            $skills = query("SELECT * FROM skills");
            
            foreach($data as $datum)
            {
                $genres[] = $datum["name"];
            }
            render("group_create_form.php", ["title" => "Create Group", "genres" => $genres, "instruments" => $instruments,
                                             "skills" => $skills]);
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
            
            // enter owner's instrument into database
            query("INSERT INTO groupinsts (groupid, instrument, userid) VALUES(?, ?, ?)", $id, $_POST["instrument"], $_SESSION["id"]);
            
            $instruments = [];
            
            $data = query("SELECT * FROM insttypes");
            
            foreach($data as $datum)
            {
                $instruments[] = $datum["instrument"];
            }

            render("group_inst_form.php", ["number" => $_POST["number"], "id" => $id, "instruments" => $instruments, "title" => "Select Instruments"]);
        }
    } 

?>
