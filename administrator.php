<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
    echo "Universities :";
    echo getTableWithAllUniversities();
    echo getTableWithAllDepartments("cmit");
    include 'footer.php'
?>
