<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached via GET
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
            render("login_form.php", ["title" => "Log In"]);
    }
    // if user reached page via POST
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $id = $_POST["id"];
        unset($_POST["id"]); 
        foreach($_POST as $instrument)
        {
        query("INSERT INTO groupinsts (groupid, instrument) VALUES(?, ?)", $id, $instrument);
        }
        
        // render succes form
        redirect("profile.php");
    } 

