<?php
    include 'functions.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "STUDENT");
    $username = $_SESSION['user'];
    include 'menu.php';

    echo "<h3>Welcome: " . $username . "</h3>";
    echo "<p>This is you grades: </p>";
    echo arrayFromStudentGrades($username);


?>
