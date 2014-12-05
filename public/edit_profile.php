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
            $username = query("SELECT username FROM users WHERE id = ?", $_SESSION["id"])[0]["username"];
            $name = query("SELECT name FROM users WHERE id = ?", $_SESSION["id"])[0]["name"];
            $email = query("SELECT email FROM users WHERE id = ?", $_SESSION["id"])[0]["email"];
            
            render("edit_form.php", ["username" => $username, "name" => $name, "email" => $email]);
        }
        
        // else render login form
        else
            render("login_form.php", ["title" => "Log In"]);
    }
    
    // if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // attempt to update info
        if (query("UPDATE users SET username = ?, name = ?, email = ? WHERE id = ?", $_POST["username"], $_POST["name"], $_POST["email"], $_SESSION["id"]) === false)
            apologize("This username is already being used");
        
        // render succes form
        else
            redirect("profile.php");
    } 

?>
