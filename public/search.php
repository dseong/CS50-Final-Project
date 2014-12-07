<?php
/*
// implements the search function of our website
// user can search for a group with one or multiple bounds
// results will satisfy all bounds inputted so multiple bounds can be used to narrow down interest
*/
    // Include configuration
    require("../includes/config.php");

    // Pull out user id and create data array for rendering
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
        // User entered a search query on previous page.
        // Do search actions
        // User submitted the form
        
        // Prepare query string list, base string and arguments for making SQL
        $arguments = [];
        $qstrs = [];
        // Base query only selects the columns we want to select
        $sql = "SELECT G.id, G.name, U.username, G.description, G.genre, S.description AS skill, (SELECT COUNT(id) FROM groupinsts WHERE groupid=G.id) as slotcnt, (SELECT COUNT(id) FROM groupinsts WHERE groupid=G.id AND userid IS NOT NULL) as fullslot FROM groups AS G LEFT JOIN users AS U ON G.ownerid = U.id INNER JOIN skills AS S ON G.skill = S.id";
        
        if(array_key_exists("username", $_GET) && !empty($_GET["username"]))
        {
            // User entered value into username, add to query string to filter results
            $qstrs[] = "U.username = ?";
            $arguments[] = $_GET["username"];
        }
        
        if(array_key_exists("members", $_GET) && !empty($_GET["members"]))
        {
            // User entered value into members, add to query string to filter results
            // This query selects groups having at least one of these members
            $qstrs[] = "G.id IN (SELECT groupid FROM groupinsts AS GI LEFT JOIN users AS UD ON GI.userid=UD.id WHERE FIND_IN_SET(UD.username,?))";
            $arguments[] = $_GET["members"];
        }
        
        if(array_key_exists("instrument", $_GET) && !empty($_GET["instrument"]) && $_GET["instrument"] !== "--none--")
        {
            // User entered value into instrument, add to query string to filter results
            // Find groups with an open slot for this instrument
            $qstrs[] = "G.id IN (SELECT groupid FROM groupinsts AS GI WHERE GI.instrument=? AND GI.userid IS NULL)";
            $arguments[] = $_GET["instrument"];
        }
        
        if(array_key_exists("skill", $_GET) && !empty($_GET["skill"]) && $_GET["skill"] !== "--none--")
        {
            // User entered value into skill, add to query string to filter results
            $qstrs[] = "G.skill = ?";
            $arguments[] = $_GET["skill"];
        }
        
        if(array_key_exists("genre", $_GET) && !empty($_GET["genre"]) && $_GET["genre"] !== "--none--")
        {
            // User entered value into genre, add to query string to filter results
            $qstrs[] = "G.genre = ?";
            $arguments[] = $_GET["genre"];
        }
        
        // We have query strings, concatenate them together with AND
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
        // Limit search results to 30 so we don't list too many
        $sql = $sql . " LIMIT 30";

        // Call query function. We use this method to call with our array of arguments
        $query_res = call_user_func_array("query", array_merge([0 => $sql], $arguments));
        if($query_res === false)
        {
            // Database error
            apologize("An error occurred while performing your search.");
        }
        
        // Prep values for rendering
        $data["results"] = $query_res;
        $data["username"] = $_GET["username"];
        $data["members"] = $_GET["members"];
        $data["selinstrument"] = $_GET["instrument"];
        $data["selskill"] = $_GET["skill"];
        $data["selgenre"] = $_GET["genre"];
        $data["search"] = true;
    }
    else
    {
        $data["results"] = "";
        $data["username"] = "";
        $data["members"] = "";
        $data["selinstrument"] = "";
        $data["selskill"] = "";
        $data["selgenre"] = "";
        $data["search"] = false;
    }
    
    // Select values to be used in dropdowns
    $data["skills"] = query("SELECT * FROM skills");
    $data["instruments"] = query("SELECT * FROM insttypes");
    $data["genres"] = query("SELECT * FROM genres");
    $data["title"] = "Search";
    // Render the resulting page
    render("search_form.php", $data);
?>
