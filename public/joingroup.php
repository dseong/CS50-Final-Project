<?php
/*
// allows user to join group
// once user selects to join group, displays the obtains the list of instruments that the user has indicated they play AND is available in the group of interest
*/
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
            
            $data = query("SELECT DISTINCT G.instrument FROM groupinsts AS G WHERE groupid=? AND instrument IN (SELECT INS.instrument FROM instruments AS INS WHERE userid=?)", $_GET["id"], $_SESSION["id"]);
            
            foreach($data as $datum)
            {
                $freeinstruments[] = $datum["instrument"];
            }
            
            render("joingroup_form.php", ["freeinstruments"=>$freeinstruments,
                                   "groupid"=>$_GET["id"]]);
     }
     
     
?>
