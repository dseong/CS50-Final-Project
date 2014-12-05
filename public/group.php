<?php

    // configuration
    require("../includes/config.php");
    
    $groupid = $_GET["id"];

    if(empty($groupid))
    {
        apologize("You must request a group.");
    }
    $userisowner = false;
    $userismember = false;
    
    $groupinfo = query("SELECT * FROM groups LEFT JOIN users ON groups.ownerid = users.id WHERE groups.id = ?", $groupid);
    $userisowner = ($groupinfo[0]["ownerid"] === $_SESSION["id"]);
    
    $groupslots = query("SELECT * FROM groupinsts LEFT JOIN users ON users.id = groupinsts.userid WHERE groupinsts.groupid = ?", $groupid);
    $memberquery = query("SELECT * FROM groupinsts WHERE groupid = ? AND userid = ?", $groupid, $_SESSION["id"]);
    if($memberquery === false || $groupinfo === false || $userisowner === false || $groupslots === false)
    {
        apologize("Invalid");
    }
    else
    {
        $userismember = !empty($memberquery) || $userisowner;
    }
    
    $data []= 
    $data["groupinfo"] = $groupinfo[0];
    $data["userisowner"] = $userisowner;
    $data["userismember"] = $userismember;
    $data["slots"] = $groupslots;
    $data["title"] = "View Group";
    
    render("group_form.php", $data);
    

     
    
?>
