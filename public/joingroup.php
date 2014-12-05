<?php

    // configuration
    require("../includes/config.php");

    
     // checks for submission button
     if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
          // updates application table
          $query_res = query("INSERT INTO applications (userid, groupid, instrument, message) VALUES (?,?,?,?)", $_SESSION["id"], $_POST["groupid"], $_POST["instrument"], $_POST["message"]);
          if($query_res === false)
          {
            apologize("Database Error");
          }
          redirect("/group.php?id=".intval($_POST["groupid"]));
     }
     
     else
     {
        // array for instruments slots that are open in the desired group     
        $freeinstruments = [];
            
            $data = query("SELECT DISTINCT instrument FROM groupinsts WHERE groupid=?", $_GET["id"]);
            
            foreach($data as $datum)
            {
                $freeinstruments[] = $datum["instrument"];
            }
            
            render("joingroup_form.php", ["freeinstruments"=>$freeinstruments,
                                   "groupid"=>$_GET["id"]]);
     }
     
     
?>
