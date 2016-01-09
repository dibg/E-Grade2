<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "3163_3362_3374";

$link = mysql_connect($host, $dbUsername, $dbPassword) or die("Cannot connect to host.");
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
mysql_select_db($database) or die("Cannot connect to database.");
?>