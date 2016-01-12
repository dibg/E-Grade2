<?php
    $path = $_SERVER["SCRIPT_NAME"];
    $file = basename($path, ".php");

    if(isset($_SESSION['role']) && $_SESSION['role'] != null){
        $role = $_SESSION['role'];
    } else {
        $role = "GUEST";
    }

    if ($role == "STUDENT") {
        ?>
        <ul>
            <li><a href="student.php"  <?php if(basename($_SERVER['PHP_SELF'], ".php") == "student") echo 'class = active' ; ?> >Home</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($role == "PROFESSOR") {
        ?>
        <ul>
            <li><a href="professor.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "professor") echo 'class = active' ; ?> >Home</a></li>
            <li><a href="manageGrades.php"  <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageGrades") echo 'class = active' ; ?> class = active>Manage Grades</a></li>

            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    }
    else if ($role == "SECRETARY") {
        ?>
        <ul>
            <li><a href="secretary.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "secretary") echo 'class = active' ; ?> >Home</a></li>
            <li><a href="manageProfessors.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageProfessors") echo 'class = active' ; ?> >Professors</a></li>
            <li><a href="manageStudents.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageStudents") echo 'class = active' ; ?> >Students</a></li>
            <li><a href="manageClasses.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageClasses") echo 'class = active' ; ?> >Classes</a></li>
            <li><a href="manageCourses.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageCourses") echo 'class = active' ; ?> >Courses</a></li>
            <li><a href="manageGrades.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageGrades") echo 'class = active' ; ?> >Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($role == "ADMIN") {
        ?>
        <ul>
            <li><a href="administrator.php">Home</a></li>
            <li><a href="manageUniversities.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageUniversities") echo 'class = active' ; ?>>Universities</a></li>
            <li><a href="manageDepartments.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageDepartments") echo 'class = active' ; ?>>Departments</a></li>
            <li><a href="manageProfessors.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageProfessors") echo 'class = active' ; ?>>Professors</a></li>
            <li><a href="manageStudents.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageStudents") echo 'class = active' ; ?>>Students</a></li>
            <li><a href="manageClasses.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageStudents") echo 'class = active' ; ?>>Classes</a></li>
            <li><a href="manageCourses.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageCourses") echo 'class = active' ; ?>>Courses</a></li>
            <li><a href="manageGrades.php" <?php if(basename($_SERVER['PHP_SELF'], ".php") == "manageGrades") echo 'class = active' ; ?>>Grades</a></li>
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

