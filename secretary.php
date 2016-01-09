<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "SECRETARY");
$username = $_SESSION['user'];

echo "<h1>Welcome: " . $username . "</h1>";

    include 'footer.php'
?>
