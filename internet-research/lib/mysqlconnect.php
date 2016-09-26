<?php
include 'lib/mysql_credentials.php';
$dbname = "bookmarks";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//DEFINE TABLES
//TABLE PREFIX DEFINED PREVIOUSLY
$table_tags = $_SESSION['table'] . "_tags";
$table_bm = $_SESSION['table'] . "_bookmarks";
$table_map = $_SESSION['table'] . "_map";
?>