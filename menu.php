<?php
    $path = $_SERVER["SCRIPT_NAME"];
    $file = basename($path, ".php");

    if ($file == "student") {
        ?>
        <ul>
            <li><a href="student.php" class = active>Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="login.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($file == "professor") {
        ?>
        <ul>
            <li><a href="professor.php" class = active>Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="login.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    }
    else if ($file == "secretary") {
        ?>
        <ul>
            <li><a href="secretary.php" class = active>Manage Students</a></li>
            <li><a href="secretary.php">Manage Professors</a></li>
            <li><a href="secretary.php">Manage Classes</a></li>
            <li><a href="secretary.php">Manage Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="login.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($file == "administrator") {
        ?>
        <ul>
            <li><a href="administrator.php" class = active>Manage Universities</a></li>
            <li><a href="administrator.php">Manage Departments</a></li>
            <li><a href="administrator.php">Manage Professors</a></li>
            <li><a href="administrator.php">Manage Students</a></li>
            <li><a href="administrator.php">Manage Classes</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="login.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else {
        //nothing
    }

    function showMenuBar($userRole) {
    }
?>

