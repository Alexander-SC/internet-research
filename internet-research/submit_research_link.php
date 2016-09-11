<?php 
$postname = mysqli_real_escape_string($connection, strip_tags(trim($_POST['name'])));
$posturl = mysqli_real_escape_string($connection, strip_tags(trim($_POST['url'])));
$postnotes = mysqli_real_escape_string($connection, strip_tags(trim($_POST['notes'])));

if (isset($_POST['rtags'])) {
    $posttags = $_POST['rtags'];
    $length = count($posttags);
} else {
    $posttags = "19"; //None defined
}

$sql_insert1 = 
    "INSERT INTO rbookmarks (rbm_title, rbm_url, rbm_notes)
    VALUES ('$postname', '$posturl', '$postnotes')";

//$sql_insert2 = 
    //"INSERT INTO rbm_rtag_map (rbm_map_id, rtag_map_id)
   // VALUES ('$postname', '$posturl')
   // WHERE rmap_id = '$rtag'";

if ($connection->query($sql_insert1) === TRUE) {
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