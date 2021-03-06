<?php
/*
// edit user's own profile
// fields available to be edited include username, name, email
*/
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
            
            render("edit_form.php", ["username" => $username, "name" => $name, "email" => $email, "title" => "Edit Profile"]);
        }
        
        // else render login form
        else
            render("login_form.php", ["title" => "Log In"]);
    }
    
    // if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // make sure user didn't completely delete any info
        if (empty($_POST["username"]))
            apologize("Please provide username");
        else if (empty($_POST["email"]))
            apologize("Please provide email");
        if (preg_match("^\S+@\S+(\.[A-Za-z]+)$^", $_POST["email"]) !== 1)
            apologize("Please provide a valid email");
        else if (empty($_POST["username"]))
            apologize("Please provide name");
            
        // attempt to update info
        else if (query("UPDATE users SET username = ?, name = ?, email = ? WHERE id = ?", $_POST["username"], $_POST["name"], $_POST["email"], $_SESSION["id"]) === false)
            apologize("This username is already being used");
        
        // render succes form
        else
            redirect("profile.php");
    } 

?>
