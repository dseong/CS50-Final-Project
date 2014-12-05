<?php

    // Include configuration
    require("../includes/config.php");

    $data = [];
    $userid = $_SESSION["id"];
    
    /* Can search by:
        - Group owner (username)
        - Members in group (username)
        - Looking for (instrument)
        - Skill level
        - Genre
    */
    
    if(array_key_exists("search", $_GET) && $_GET["search"] === "yes")
    {
        // User submitted the form
        $data["results"] = [];
        $data["restore"] = true;
        
        $arguments = [];
        $qstrs = [];
        $sql = "SELECT G.id, G.name, U.username, G.description, S.description AS skill, (SELECT COUNT(id) FROM groupinsts WHERE groupid=G.id) as slotcnt, (SELECT COUNT(id) FROM groupinsts WHERE groupid=G.id AND userid IS NOT NULL) as fullslot FROM groups AS G LEFT JOIN users AS U ON G.ownerid = U.id INNER JOIN skills AS S ON G.skill = S.id";
        
        if(array_key_exists("username", $_GET) && !empty($_GET["username"]))
        {
            $qstrs[] = "U.username = ?";
            $arguments[] = $_GET["username"];
        }
        
        if(array_key_exists("members", $_GET) && !empty($_GET["members"]))
        {
            $qstrs[] = "G.id IN (SELECT groupid FROM groupinsts AS GI LEFT JOIN users AS UD ON GI.userid=UD.id WHERE FIND_IN_SET(UD.username,?))";
            $arguments[] = $_GET["members"];
        }
        
        if(array_key_exists("instrument", $_GET) && !empty($_GET["instrument"]) && $_GET["instrument"] !== "--none--")
        {
            $qstrs[] = "G.id IN (SELECT groupid FROM groupinsts AS GI WHERE GI.instrument=? AND GI.userid IS NULL)";
            $arguments[] = $_GET["instrument"];
        }
        
        if(array_key_exists("skill", $_GET) && !empty($_GET["skill"]) && $_GET["skill"] !== "--none--")
        {
            $qstrs[] = "G.skill = ?";
            $arguments[] = $_GET["skill"];
        }
        
        if(array_key_exists("genre", $_GET) && !empty($_GET["genre"]) && $_GET["genre"] !== "--none--")
        {
            $qstrs[] = "G.genre = ?";
            $arguments[] = $_GET["genre"];
        }
        
        if(!empty($qstrs))
        {
            $sql = $sql . " WHERE";
            $first = true;
            foreach($qstrs as $qstr)
            {
                if($first)
                {
                    $sql = $sql . " " . $qstr;
                    $first = false;
                }
                else
                {
                    $sql = $sql . " AND " . $qstr;
                }
            }
        }
        $sql = $sql . " LIMIT 30";
        
        $query_res = call_user_func_array("query", array_merge([0 => $sql], $arguments));
        if($query_res === false)
        {
            apologize("An error occurred while performing your search.");
        }
        
        $data["results"] = $query_res;
        $data["username"] = $_GET["username"];
        $data["members"] = $_GET["members"];
        $data["instrument"] = $_GET["instrument"];
        $data["skill"] = $_GET["skill"];
        $data["genre"] = $_GET["genre"];
    }
    else
    {
        $data["results"] = "";
        $data["username"] = "";
        $data["members"] = "";
        $data["instrument"] = "";
        $data["skill"] = "";
        $data["genre"] = "";
    }
    
    $data["skills"] = query("SELECT * FROM skills");
    $data["instruments"] = query("SELECT * FROM insttypes");
    $data["genres"] = query("SELECT * FROM genres");
    $data["title"] = "Search";
    render("search_form.php", $data);
?>
