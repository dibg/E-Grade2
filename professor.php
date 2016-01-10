<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "PROFESSOR");
$username = $_SESSION['user'];

echo "<h1>Welcome: " . $username . "</h1>";

    include 'footer.php'
?>