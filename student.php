<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "STUDENT");
    $username = $_SESSION['user'];

    echo "<h3>Welcome: " . $username . "</h3>";
    echo "<p>This is your grades: </p>";
    echo getTableWithStudentGrades($username);

    include 'footer.php'
?>
