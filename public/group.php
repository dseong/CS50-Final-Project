<?php
/*
// displays information about the group
// fields displayed include the information about the group as well as owner and open slots/occupied slots with member information
*/
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
    $groupinfo = query("SELECT users.name AS uname, groups.name AS gname, username, ownerid, groups.
    description, genre, S.description AS skill, email FROM groups LEFT JOIN users ON groups.ownerid = users.id INNER JOIN skills AS S ON groups.skill = S.id WHERE groups.id = ?", $groupid);
    // pulls all of info regarding slots in group including members
    $groupslots = query("SELECT users.username, users.email, users.name, groupinsts.instrument, groupinsts.id, groupinsts.groupid FROM groupinsts LEFT JOIN users ON users.id = groupinsts.userid WHERE groupinsts.groupid = ?", $groupid);
    // to check whether user is member or not
    $memberquery = query("SELECT * FROM groupinsts WHERE groupid = ? AND userid = ?", $groupid, $_SESSION["id"]);
    // Check whether user has instrument in common with group
    $instcount = query("SELECT COUNT(I.instrument) AS instcount FROM instruments AS I WHERE userid=? AND I.instrument IN (SELECT B.instrument FROM groupinsts AS B WHERE B.userid IS NULL AND B.groupid = ?)", $_SESSION["id"], $groupid);
    
    // checks for any query errors
    if($memberquery === false || $groupinfo === false || $groupslots === false || $instcount === false)
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
    $data["title"] = $groupinfo[0]["gname"];
    $data["groupid"] = $groupid;
    $data["commoninst"] = ($instcount[0]["instcount"] > 0);
    
    // pass to form
    render("group_form.php", $data);
    

     
    
?>
