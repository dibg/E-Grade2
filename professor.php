<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "PROFESSOR");

    echo "you are in the professor page";

    include 'footer.php'
?>