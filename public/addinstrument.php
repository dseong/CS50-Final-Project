<?php

    // configuration
    require("../includes/config.php");

    // else if user reached page via POST (as by submitting a form via POST)
    $instruments = ["Violin", "Viola", "Cello", "Piano", "Base"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    { 
    
        if (in_array($_POST["instrument"], $instruments) === TRUE)
        {
            $previnst = query("SELECT instrument FROM instruments WHERE id = ?", $_SESSION["id"]);
            if ($previnst !== $_POST["instrument"])
            {
                query("INSERT INTO instruments (userid, instrument) VALUES (?,?)", $_SESSION["id"], $_POST["instrument"]);
                redirect("profile.php");
            }
            
            else
            {
                apologize("You have already selected that instrument previously");
            }
        }
    
        else
        {
            apologize("Please select a valid instrument from the drop down menu");
        }
        
        
    }
    // if user reached page via GET (as by clicking a link or via redirect)
    else
    {
       render("addinstrument_form.php", ["instruments" => $instruments, "title" => "Add Instrument"]);
    }
     
     
    
?>
