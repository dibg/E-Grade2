<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
    include 'footer.php'
?>
