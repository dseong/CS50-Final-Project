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
            $applications = query("SELECT * FROM applications");
            
            // pass in an array of linked list to the form, each representing one application
            // just passing in the result of the query won't suffice, because some information should be used to retrieve new information
            // maybe just modify the existing linked list
            
            $n = count($applications);
            for($i = 0; $i < $n; $i++)
            {
                $applications[$i]["username"] = query("SELECT username FROM users WHERE id = ?", $applications[$i]["userid"])[0]["username"];
                $applications[$i]["group"] = query("SELECT name FROM groups WHERE id = ?", $applications[$i]["groupid"])[0]["name"];
            }
            render("application_view.php", ["applications" => $applications]);
        }
        
        // else render login form
        else
            render("login_form.php", ["title" => "Log In"]);
    }

?>
