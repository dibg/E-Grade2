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
            <li><a href="student.php"  <?php if($file == "student") echo 'class = active' ; ?> >Home</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($role == "PROFESSOR") {
        ?>
        <ul>
            <li><a href="professor.php" <?php if($file == "professor") echo 'class = active' ; ?> >Home</a></li>
            <li><a href="manageGrades.php"  <?php if($file == "manageGrades") echo 'class = active' ; ?>>Manage Grades</a></li>

            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    }
    else if ($role == "SECRETARY") {
        ?>
        <ul>
            <li><a href="secretary.php" <?php if($file == "secretary") echo 'class = active' ; ?> >Home</a></li>
            <li><a href="manageProfessors.php" <?php if($file == "manageProfessors") echo 'class = active' ; ?> >Professors</a></li>
            <li><a href="manageStudents.php" <?php if($file == "manageStudents") echo 'class = active' ; ?> >Students</a></li>
            <li><a href="manageClasses.php" <?php if($file == "manageClasses") echo 'class = active' ; ?> >Classes</a></li>
            <li><a href="manageCourses.php" <?php if($file == "manageCourses") echo 'class = active' ; ?> >Courses</a></li>
            <li><a href="manageGrades.php" <?php if($file == "manageGrades") echo 'class = active' ; ?> >Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else if ($role == "ADMIN") {
        ?>
        <ul>
            <li><a href="administrator.php" <?php if($file == "administrator") echo 'class = active' ; ?>>Home</a></li>
            <li><a href="manageUniversities.php" <?php if($file == "manageUniversities") echo 'class = active' ; ?>>Universities</a></li>
            <li><a href="manageDepartments.php" <?php if($file == "manageDepartments") echo 'class = active' ; ?>>Departments</a></li>
            <li><a href="manageProfessors.php" <?php if($file == "manageProfessors") echo 'class = active' ; ?>>Professors</a></li>
            <li><a href="manageStudents.php" <?php if($file == "manageStudents") echo 'class = active' ; ?>>Students</a></li>
            <li><a href="manageClasses.php" <?php if($file == "manageClasses") echo 'class = active' ; ?>>Classes</a></li>
            <li><a href="manageCourses.php" <?php if($file == "manageCourses") echo 'class = active' ; ?>>Courses</a></li>
            <li><a href="manageGrades.php" <?php if($file == "manageGrades") echo 'class = active' ; ?>>Grades</a></li>
            <ul style="float:right;list-style-type:none;">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </ul>
        <?php
    } else {
        // menu is not available for guest users
    }

?>

