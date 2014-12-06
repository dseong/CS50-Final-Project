<?php

    // configuration
    require("../includes/config.php");
    
    $application = query("SELECT A.id, A.userid, A.groupid, A.instrument FROM applications AS A WHERE A.groupid IN (SELECT groupid FROM groups WHERE ownerid=?) AND A.id = ?", $_SESSION["id"], $_GET["id"])[0];
    if($_GET["choice"] === "yes")
    {
        $updateslot = query("UPDATE groupinsts AS U SET U.userid = ? WHERE U.instrument = ? AND U.groupid = ? AND U.userid IS NULL LIMIT 1", $application["userid"], $application["instrument"], $application["groupid"]);
    }
    $removeapp = query("DELETE FROM applications WHERE id = ?", $application["id"]);
    redirect("/request_response.php?id=".$application["groupid"]);
?>
