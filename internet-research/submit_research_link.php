<?php 

$postname = $_POST['name'];
$posturl = $_POST['url'];
$postnotes = $_POST['notes'];

if (isset($_POST['rtags'])) {
    $posttags = implode(', ',$_POST['rtags']);
} else {
    $posttags = "";
}

$sql_insert = "INSERT INTO do_research (name, url, tags, notes)
    VALUES ('$postname', '$posturl', '$posttags', '$postnotes')";

if ($connection->query($sql_insert) === TRUE) {
    echo "<font color=\"#00b300\">Added new link: </font>" . $postname;
} else {
    echo "Something went wrong. Link not added.<br>" . $connection->error;
}

?>