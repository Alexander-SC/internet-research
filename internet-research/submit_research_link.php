<?php 
$postname = mysqli_real_escape_string($connection, strip_tags(trim($_POST['name'])));
$posturl = mysqli_real_escape_string($connection, strip_tags(trim($_POST['url'])));
$postnotes = mysqli_real_escape_string($connection, strip_tags(trim($_POST['notes'])));
$shortdesc = mysqli_real_escape_string($connection, strip_tags(trim($_POST['shortdesc'])));



//CHECK IF TAGS WERE SELECTED
if (isset($_POST['rtags'])) {
    $post_tags = $_POST['rtags'];
//CHECK IF NO NEW TAGS AND NO CHECKED TAGS
} elseif (empty($_POST['newtag']) && empty($_POST['rtags'])) {
    $post_tags = array("19"); //None defined
}

//ADD BOOKMARK, NEW TAG, AND MAP TOGETHER
$sql_insert_r_bookmarks = 
"INSERT INTO r_bookmarks (bmTitle, bmURL, bmShortDesc, bmNotes)
VALUES ('$postname', '$posturl', '$shortdesc', '$postnotes')";

if ($connection->query($sql_insert_r_bookmarks) === TRUE) {
    //GET NEW BOOKMARK ID FOR USAGE IN MAP
    $sql_get_bmID =
    "SELECT bmID
    FROM r_bookmarks
    ORDER BY bmID DESC
    LIMIT 1";
    $new_bmID = mysqli_fetch_assoc($connection->query($sql_get_bmID));
    $new_bmMapID = $new_bmID['bmID'];

    //CHECK IF NEW TAG WAS SUBMITTED AND CREATE SQL CODE
    if (!empty($_POST['newtag'])) {
        $newtag = mysqli_real_escape_string($connection, strip_tags(trim($_POST['newtag'])));
        
        $sql_insert_newtag =
        "INSERT INTO r_tags (tagName)
        VALUES ('$newtag')";
        
        if ($connection->query($sql_insert_newtag) === TRUE) {
            //GET ID OF NEW TAG
            $sql_get_newtag_id =
            "SELECT tagID
            FROM r_tags
            ORDER BY tagID DESC
            LIMIT 1";
            
            $get_newtag_id = mysqli_fetch_assoc($connection->query($sql_get_newtag_id));
            $newtag_id = $get_newtag_id['tagID'];
            
            //LINK NEW TAG WITH NEW BOOKMARK
            $sql_insert_newtag_to_map =
            "INSERT INTO r_map (bmMapID, tagMapID)
            VALUES ($new_bmMapID, $newtag_id)";
            $connection->query($sql_insert_newtag_to_map);
        } else {
            echo "ERROR: New tag not inserted.";
        }
    }
    
    if (isset($post_tags)) {
        foreach ($post_tags as $tag) {
            $sql_insert_r_map =
                "INSERT INTO r_map (bmMapID, tagMapID)
                VALUES ($new_bmMapID, $tag)";
            $connection->query($sql_insert_r_map);
        }
    }
    
    echo "<font color=\"#00b300\">Added new link: </font>" . $postname;
} else {
    echo "Something went wrong. Link not added.<br>" . $connection->error;
}

//GET ID OF NEW BOOKMARK
$biggest_bmID_result = $connection->query(
    "SELECT bmID
    FROM r_bookmarks
    ORDER BY bmID DESC
    LIMIT 1");

$row = $biggest_bmID_result->fetch_assoc();
echo " (Bookmark #" . $row['bmID'] . ")";
  
?>