<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached via GET, passing in necessary variables
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // make sure user is logged in
        if (!empty($_SESSION["id"]))
        {
            // check to make sure user is owner
            if (query("SELECT ownerid FROM groups WHERE id = ?", $_GET["groupid"])[0]["ownerid"] != $_SESSION["id"])
                apologize("You don't have permission to do that");
                
            // add person to group if that was the owner's choice
            if($_GET["choice"] == 1)
            {
                // retrieve rows that contain the applicant's instrument
                $rows = query("SELECT * FROM groupinsts WHERE instrument = ? AND groupid = ?", $_GET["instrument"], $_GET["groupid"]);
                if ($rows === NULL)
                    apologize("That user's instrument is not an option in the group");
                
                // iterate over these rows to find the first with an available slot
                foreach($rows as $row)
                {
                    if (query("SELECT userid FROM groupinsts WHERE id = ?", $row["id"])[0]["userid"] === NULL)
                    {
                        if (query("UPDATE groupinsts SET userid = ? WHERE id = ?", $_GET["userid"], $row["id"]) === FALSE)
                            apologize("Unable to add to group");
                            
                        // delete request
                        query("DELETE FROM applications WHERE id = ?", $_GET["id"]);    
                                   
                        // redirect to request list page
                        redirect("request_response.php");
                    }
                }
                apologize("The group doesn't need any more of this instrument");
            }
            
            // delete request (need this if person wasn't added)
            query("DELETE FROM applications WHERE id = ?", $_GET["id"]);
            
            // redirect to request list page
            redirect("request_response.php");
        }
        
        // else render login form
        else
            render("login_form.php", ["title" => "Log In"]);
    }

?>
