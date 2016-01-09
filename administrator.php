<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
    echo "you are in the admin page";

    include 'footer.php'
?>
