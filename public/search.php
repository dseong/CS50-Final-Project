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
    
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        // User submitted the form
        $data["results"] = [];
        $data["restore"] = true;
        
        $arguments = [];
        $qstrs = [];
        $sql = "SELECT G.id, G.name, U.username, G.description, S.description AS skill FROM groups AS G LEFT JOIN users AS U ON G.ownerid = U.id INNER JOIN skills AS S ON G.skill = S.id";
        
        if(array_key_exists("username", $_POST) && !empty($_POST["username"]))
        {
            $qstrs[] = "U.username = ?";
            $arguments[] = $_POST["username"];
        }
        
        if(array_key_exists("members", $_POST) && !empty($_POST["members"]))
        {
            $qstrs[] = "G.id IN (SELECT groupid FROM groupinsts AS GI LEFT JOIN users AS UD ON GI.userid=UD.id WHERE FIND_IN_SET(UD.username,?))";
            $arguments[] = $_POST["members"];
        }
        
        if(array_key_exists("instrument", $_POST) && !empty($_POST["instrument"]) && $_POST["instrument"] !== "--none--")
        {
            $qstrs[] = "G.id IN (SELECT groupid FROM groupinsts AS GI WHERE GI.instrument=? AND GI.userid IS NULL)";
            $arguments[] = $_POST["instrument"];
        }
        
        if(array_key_exists("skill", $_POST) && !empty($_POST["skill"]) && $_POST["skill"] !== "--none--")
        {
            $qstrs[] = "G.skill = ?";
            $arguments[] = $_POST["skill"];
        }
        
        if(array_key_exists("genre", $_POST) && !empty($_POST["genre"]) && $_POST["genre"] !== "--none--")
        {
            $qstrs[] = "G.genre = ?";
            $arguments[] = $_POST["genre"];
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
        
        //dump(array_merge([0 => $sql], $arguments));
        $query_res = call_user_func_array("query", array_merge([0 => $sql], $arguments));
        //dump($query_res);
        
        $data["username"] = $_POST["username"];
        $data["members"] = $_POST["members"];
        $data["instrument"] = $_POST["instrument"];
        $data["skill"] = $_POST["skill"];
        $data["genre"] = $_POST["genre"];
    }
    
    $data["skills"] = query("SELECT * FROM skills");
    $data["instruments"] = query("SELECT * FROM insttypes");
    $data["genres"] = query("SELECT * FROM genres");
    $data["title"] = "Search";
    render("search_form.php", $data);
?>
