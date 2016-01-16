<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "3163_3362_3374";

$dbLink = mysqli_connect($dbHost, $dbUsername, $dbPassword) or die("Cannot connect to host.");
mysqli_query($dbLink, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
mysqli_select_db($dbLink, $dbName) or die("Cannot connect to database.");
?>