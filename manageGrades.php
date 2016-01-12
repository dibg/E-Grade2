<?php
include 'header.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY", "PROFESSOR"));


include 'footer.php';
?>

