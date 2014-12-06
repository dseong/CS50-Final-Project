<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached via GET, passing in necessary variables
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // retrieve necessary variables to fill form text boxes
        $applications = query("SELECT U.username, A.instrument, A.message, A.id, A.userid FROM applications AS A INNER JOIN users AS U ON U.id = A.userid WHERE A.groupid IN (SELECT id FROM groups AS G WHERE G.ownerid = ?) AND groupid = ?", $_SESSION["id"], $_GET["id"]);
        $groupinfo = query("SELECT name, id FROM groups WHERE id = ? AND ownerid = ?", $_GET["id"], $_SESSION["id"])[0];

        render("application_view.php", ["applications" => $applications, "groupid" => $groupinfo["id"], "name" => $groupinfo["name"]]);
    }

?>
