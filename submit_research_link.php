<?php 
$postname = mysqli_real_escape_string($connection, strip_tags(trim($_POST['name'])));
$posturl = mysqli_real_escape_string($connection, strip_tags(trim($_POST['url'])));
$postnotes = mysqli_real_escape_string($connection, strip_tags(trim($_POST['notes'])));



//CHECK IF TAGS WERE SELECTED
if (isset($_POST['rtags'])) {
    $post_tags = $_POST['rtags'];
//CHECK IF NO NEW TAGS AND NO CHECKED TAGS
} elseif (empty($_POST['newtag']) && empty($_POST['rtags'])) {
    $post_tags = array("19"); //None defined
}

//ADD BOOKMARK, NEW TAG, AND MAP TOGETHER
$sql_insert_rbookmarks = 
"INSERT INTO rbookmarks (rbm_title, rbm_url, rbm_notes)
VALUES ('$postname', '$posturl', '$postnotes')";

if ($connection->query($sql_insert_rbookmarks) === TRUE) {
    //GET NEW BOOKMARK ID FOR USAGE IN MAP
    $sql_get_rbm_id =
    "SELECT rbm_id
    FROM rbookmarks
    ORDER BY rbm_id DESC
    LIMIT 1";
    $new_rbm_id = mysqli_fetch_assoc($connection->query($sql_get_rbm_id));
    $new_rbm_map_id = $new_rbm_id['rbm_id'];

    //CHECK IF NEW TAG WAS SUBMITTED AND CREATE SQL CODE
    if (!empty($_POST['newtag'])) {
        $newtag = mysqli_real_escape_string($connection, strip_tags(trim($_POST['newtag'])));
        
        $sql_insert_newtag =
        "INSERT INTO rtags (rtag_name)
        VALUES ('$newtag')";
        
        if ($connection->query($sql_insert_newtag) === TRUE) {
            //GET ID OF NEW TAG
            $sql_get_newtag_id =
            "SELECT rtag_id
            FROM rtags
            ORDER BY rtag_id DESC
            LIMIT 1";
            
            $get_newtag_id = mysqli_fetch_assoc($connection->query($sql_get_newtag_id));
            $newtag_id = $get_newtag_id['rtag_id'];
            
            //LINK NEW TAG WITH NEW BOOKMARK
            $sql_insert_newtag_to_map =
            "INSERT INTO rbm_rtag_map (rbm_map_id, rtag_map_id)
            VALUES ($new_rbm_map_id, $newtag_id)";
            $connection->query($sql_insert_newtag_to_map);
        } else {
            echo "ERROR: New tag not inserted.";
        }
    }
    
    if (isset($post_tags)) {
        foreach ($post_tags as $tag) {
            $sql_insert_rmap =
                "INSERT INTO rbm_rtag_map (rbm_map_id, rtag_map_id)
                VALUES ($new_rbm_map_id, $tag)";
            $connection->query($sql_insert_rmap);
        }
    }
    
    echo "<font color=\"#00b300\">Added new link: </font>" . $postname;
} else {
    echo "Something went wrong. Link not added.<br>" . $connection->error;
}

//GET ID OF NEW BOOKMARK
$biggest_rbm_id_result = $connection->query(
    "SELECT rbm_id
    FROM rbookmarks
    ORDER BY rbm_id DESC
    LIMIT 1");

$row = $biggest_rbm_id_result->fetch_assoc();
echo " (Bookmark #" . $row['rbm_id'] . ")";
  
?>