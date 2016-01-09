<?php
    include 'header.php';
    echo "Universities :";
    echo getTableWithAllUniversities();
    echo getTableWithAllDepartments("cmit");

    include 'footer.php';
?>