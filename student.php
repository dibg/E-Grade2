<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "STUDENT");
    $username = $_SESSION['user'];

echo "<h1>Welcome: " . $username . "</h1>";
echo "<h4>These are your grades: </h4>";
    echo getTableWithStudentGrades($username);

    include 'footer.php'
?>
