<?php
include 'test_mysql_credentials.php';
$dbname = "ir_bookmarks";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>