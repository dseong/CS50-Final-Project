<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // error checks for all cases
        if (empty($_POST["username"]))
        apologize("Please provide username"); 
        
        if (empty($_POST["name"]))
        apologize("Please provide username"); 
        
        if (empty($_POST["email"]))
        apologize("Please provide username"); 
        
        else if (empty($_POST["password"]))
        apologize("Please provide a password");
        
        else if (empty($_POST["confirmation"]))
        apologize("Please provide a confirmation password");
        
        else if ($_POST["password"] != $_POST["confirmation"])
        apologize("Your passwords do not match");
        
        if (query("INSERT INTO users (username, hash, name, email) VALUES(?, ?, ?, ?)", $_POST["username"], crypt($_POST["password"]), $_POST["name"], $_POST["email"]) === false)
        apologize("This username is already being used");
        
        else
        {
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            
            $_SESSION["id"] = $id;
            redirect("index.php");
        }
        
        
    }
    
    else
    {
        render("register_form.php", ["title" => "Register"]);
    }
    
   

?>
