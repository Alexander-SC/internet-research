<?php 
$postname = mysqli_real_escape_string($connection, strip_tags(trim($_POST['name'])));
$posturl = mysqli_real_escape_string($connection, strip_tags(trim($_POST['url'])));
$postnotes = mysqli_real_escape_string($connection, strip_tags(trim($_POST['notes'])));

if (isset($_POST['rtags'])) {
    $posttags = mysqli_real_escape_string($connection, strip_tags(trim(implode(', ',$_POST['rtags']))));
} else {
    $posttags = "";
}

$sql_insert = "INSERT INTO about_freelance (name, url, tags, notes)
    VALUES ('$postname', '$posturl', '$posttags', '$postnotes')";

if ($connection->query($sql_insert) === TRUE) {
    echo "<font color=\"#00b300\">Added new link: </font>" . $postname;
} else {
    echo "Something went wrong. Link not added.<br>" . $connection->error;
}
?>