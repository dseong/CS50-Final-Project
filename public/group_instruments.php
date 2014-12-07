<?php
/*
// necessary to setup create group
// fills in instruments that owner wants in group
*/
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
        // gets user id
        $id = $_POST["id"];
        unset($_POST["id"]); 
        // fills in instruments that you want in your group
        foreach($_POST as $instrument)
        {
        query("INSERT INTO groupinsts (groupid, instrument) VALUES(?, ?)", $id, $instrument);
        }
        
        // render succes form
        redirect("profile.php");
    } 

