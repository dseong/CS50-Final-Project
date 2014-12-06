<?php

    // configuration
    require("../includes/config.php");
    
    $groupid = $_GET["id"];

    // error checks for selection of a group
    if(empty($groupid))
    {
        apologize("You must request a group.");
    }
    
    // to check whether user is owner or member
    $userisowner = false;
    $userismember = false;
    
    // pulls all of group info while merging owner's userid with the owner's username and email
    $groupinfo = query("SELECT users.name AS uname, groups.name AS gname, username, ownerid, description, genre, skill, email FROM groups LEFT JOIN users ON groups.ownerid = users.id WHERE groups.id = ?", $groupid);
    // pulls all of info regarding slots in group including members
    $groupslots = query("SELECT users.username, users.email, users.name, groupinsts.instrument, groupinsts.id, groupinsts.groupid FROM groupinsts LEFT JOIN users ON users.id = groupinsts.userid WHERE groupinsts.groupid = ?", $groupid);
    // to check whether user is member or not
    $memberquery = query("SELECT * FROM groupinsts WHERE groupid = ? AND userid = ?", $groupid, $_SESSION["id"]);
    
    // checks for any query errors
    if($memberquery === false || $groupinfo === false || $groupslots === false)
    {
        apologize("Invalid");
    }
    
    // to determine owner/member/nonmember status
    else
    {    
        $userisowner = ($groupinfo[0]["ownerid"] === $_SESSION["id"]);
        $userismember = !empty($memberquery) || $userisowner;
        $userisrealmember = !empty($memberquery);
    }
    
    // array with all the necessary info to display
    $data = [];
    $data["groupinfo"] = $groupinfo[0];
    $data["userisowner"] = $userisowner;
    $data["userismember"] = $userismember;
    $data["userisrealmember"] = $userisrealmember;
    $data["slots"] = $groupslots;
    $data["title"] = "View Group";
    $data["groupid"] = $groupid;
    // pass to form
    render("group_form.php", $data);
    

     
    
?>
