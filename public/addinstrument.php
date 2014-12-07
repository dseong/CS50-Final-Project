<?php
/*
// Controller for adding instruments that user plays to his/her profile page
*/

    // configuration
    require("../includes/config.php");

    // fetching instrument types from central list on php myadmin
    $instruments = [];
            
            $data = query("SELECT * FROM insttypes");
            
            foreach($data as $datum)
            {
                $instruments[] = $datum["instrument"];
            }
    
    // adding instrument        
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    { 
        // checks for instrument already in "inventory"
        if (in_array($_POST["instrument"], $instruments) === TRUE)
        {
            $previnst = query("SELECT instrument FROM instruments WHERE id = ?", $_SESSION["id"]);
            // if valid choice, inserts instrument into user profile
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

    else
    {
       render("addinstrument_form.php", ["instruments" => $instruments, "title" => "Add Instrument"]);
    }
     
     
    
?>
