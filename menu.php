<?php
    $path = $_SERVER["SCRIPT_NAME"];
    $file = basename($path, ".php");

    if(isset($_SESSION['role']) && $_SESSION['role'] != null){
        $role = $_SESSION['role'];
    } else {
        $role = "GUEST";
    }

//    if($file == "login" || $file == "index")
//    {
//        $role = "GUEST";
//    }

    if ($role == "STUDENT") {
        ?>
        <ul>
            <li><a href="student.php" class = active>Home</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($role == "PROFESSOR") {
        ?>
        <ul>
            <li><a href="professor.php" class = active>Home</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    }
    else if ($role == "SECRETARY") {
        ?>
        <ul>
            <li><a href="secretary.php" class = active>Home</a></li>
            <li><a href="manageProfessors.php">Manage Professors</a></li>
            <li><a href="manageStudents.php">Manage Students</a></li>
            <li><a href="manageClasses.php">Manage Classes</a></li>
            <li><a href="manageGrades.php">Manage Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($role == "ADMIN") {
        ?>
        <ul>
            <li><a href="administrator.php" class = active>Home</a></li>
            <li><a href="manageUniversities.php">Manage Universities</a></li>
            <li><a href="manageDepartments.php">Manage Departments</a></li>
            <li><a href="manageProfessors.php">Manage Professors</a></li>
            <li><a href="manageStudents.php">Manage Students</a></li>
            <li><a href="manageClasses.php">Manage Classes</a></li>
            <li><a href="manageGrades.php">Manage Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else {
        // menu is not available for guest users
    }

    function showMenuBar($userRole) {
    }
?>

