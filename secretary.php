<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "SECRETARY");

    echo "you are in the secretary page";

    include 'footer.php'
?>
