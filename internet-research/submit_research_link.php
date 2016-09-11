<?php 
$postname = mysqli_real_escape_string($connection, strip_tags(trim($_POST['name'])));
$posturl = mysqli_real_escape_string($connection, strip_tags(trim($_POST['url'])));
$postnotes = mysqli_real_escape_string($connection, strip_tags(trim($_POST['notes'])));

if (isset($_POST['rtags'])) {
    $post_tags = $_POST['rtags'];
    echo "tags set";
} else {
    $post_tags = "19"; //None defined
}

$sql_insert_rbookmarks = 
"INSERT INTO rbookmarks (rbm_title, rbm_url, rbm_notes)
VALUES ('$postname', '$posturl', '$postnotes')";

if ($connection->query($sql_insert_rbookmarks) === TRUE) {
    $sql_get_rbm_id =
    "SELECT rbm_id
    FROM rbookmarks
    ORDER BY rbm_id DESC
    LIMIT 1";
    $new_rbm_id = mysqli_fetch_assoc($connection->query($sql_get_rbm_id));
    $new_rbm_map_id = $new_rbm_id['rbm_id'];
    
    foreach ($post_tags as $tag) {
        $sql_insert_rmap =
            "INSERT INTO rbm_rtag_map (rbm_map_id, rtag_map_id)
            VALUES ($new_rbm_map_id, $tag)";
        $connection->query($sql_insert_rmap);
    }
    
    echo "<font color=\"#00b300\">Added new link: </font>" . $postname;
} else {
    echo "Something went wrong. Link not added.<br>" . $connection->error;
}

$biggest_rbm_id_result = $connection->query(
    "SELECT rbm_id
    FROM rbookmarks
    ORDER BY rbm_id DESC
    LIMIT 1");

$row = $biggest_rbm_id_result->fetch_assoc();
echo " (Bookmark #" . $row['rbm_id'] . ")";
  
?>