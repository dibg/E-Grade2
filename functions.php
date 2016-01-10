<?php
session_start();
include 'connection.php';

function loginAndRedirect($username, $password)
{
    if (isset($username) && isset($password)) {
        $queryStudent =     mysql_query("SELECT *  FROM student    WHERE studentUsername   = '$username' AND studentPassword    = ('$password')") or die(mysql_error());
        $queryProfessor =   mysql_query("SELECT *  FROM professor  WHERE professorUsername = '$username' AND professorPassword  = ('$password')") or die(mysql_error());
        $querySecretary =   mysql_query("SELECT *  FROM secretary  WHERE secretaryUsername = '$username' AND secretaryPassword  = ('$password')") or die(mysql_error());
        $queryAdmin =       mysql_query("SELECT *  FROM admin      WHERE adminUsername     = '$username' AND adminPassword      = ('$password')") or die(mysql_error());

        $rowStudent = mysql_fetch_array($queryStudent);
        $rowProfessor = mysql_fetch_array($queryProfessor);
        $rowSecretary = mysql_fetch_array($querySecretary);
        $rowAdmin = mysql_fetch_array($queryAdmin);

        if(isset($rowStudent['studentUsername']) && isset($rowStudent['studentPassword'])){
            $_SESSION["user"] = $rowStudent['studentUsername'];
            $_SESSION["role"] = "STUDENT";
            redirectTo("student.php");
        } else if(isset($rowProfessor['professorUsername']) && isset($rowProfessor['professorPassword'])){
            $_SESSION["user"] = $rowProfessor['professorUsername'];
            $_SESSION["role"] = "PROFESSOR";
            redirectTo("professor.php");
        }else if(isset($rowSecretary['secretaryUsername']) && isset($rowSecretary["secretaryPassword"])){
            $_SESSION["user"] = $rowSecretary['secretaryUsername'];
            $_SESSION["role"] = "SECRETARY";
            redirectTo("secretary.php");
        } else if(isset($rowAdmin['adminUsername']) && isset($rowAdmin['adminPassword'])){
            $_SESSION["user"] = $rowAdmin['adminUsername'];
            $_SESSION["role"] = "ADMIN";
            redirectTo("administrator.php");
        } else {
            $_SESSION["user"] = null;
            $_SESSION["role"] = "GUEST";
            redirectTo("login.php?login=failed");
        }
    }
}

function redirectLoginUser(){
    if (isset($_SESSION["user"]) && isset($_SESSION["role"]) && $_SESSION["user"] != null && $_SESSION["role"] != null) {
        $role = $_SESSION['role'];
        switch ($role) {
            case "ADMIN":
                redirectTo("administrator.php");
                break;
            case "SECRETARY":
                redirectTo("secretary.php");
                break;
            case "PROFESSOR":
                redirectTo("professor.php");
                break;
            case "STUDENT":
                redirectTo("student.php");
        }

    }
}

function checkAndRedirectNotAuthorizedUsers($session, $expectedRole) {
    if(isset($session)) {
        $role = $session['role'];
        if($role != $expectedRole) {
            redirectTo("accessDenied.php");
        }
    } else {
        redirectTo("accessDenied.php");
    }
}

function clearSession() {
    session_unset();
}

function redirectTo($page) {
    header("Location: " . $page);
    exit();
}

function fadeOut($element, $milliseconds) {
    echo "<script src='jquery.min.js'></script>";
    printf(').fadeOut(%d;
             )
        });
    </script>
    ', $element, $milliseconds);
}

function loginMessageHandler () {
    if(isset($_GET['login'])){
        if($_GET['login'] == 'failed'){
            fadeOut("h2", 3000);
            echo "<h2 id='warning'>The credentials is incorrect please try again.</h2>";
        } else if ($_GET['login'] == 'admin') {
            fadeOut("h2", 3000);
            echo "<h2 id='warning'>Very Funny.</h2>";
        } else if ($_GET['login'] == 'logout') {
            fadeOut("h2", 3000);
            echo "<h2 id='success'>Successful logout.</h2>";
        }
    }
}

function getStudentGrades($username) {
    $query = mysql_query("CALL getStudentGrades('$username')") or die(mysql_error());

    $result = null;
    $i = 0;
    while($row = mysql_fetch_array($query)) {
        $result[$i]['course'] = $row['courseName'];
        $result[$i]['grade'] = $row['grade'];
        $i++;
    }
    return $result;
}

function getTableWithStudentGrades($username) {
    $grades = getStudentGrades($username);
    $output = "<table align='center'><tr><th>Course</th><th>Grade</th></tr>";
    if(isset($grades) && $grades != null){
        foreach($grades as $i => $obj) {
            $course = $obj['course'];
            $grade = $obj['grade'];

            $output .= "<tr><td>$course</td><td>$grade</td></tr>";
        }
    }

    $output .="</table>";
    return $output;
}

function getAllUniversities() {
    $query = mysql_query("SELECT universityName FROM university") or die(mysql_error());
    $result = null;
    $i = 0;
    while($row = mysql_fetch_array($query)) {
        $result[$i] = $row['universityName'];
        $i++;
    }

    return $result;
}

function generateTableWithAllUniversities()
{
    $universities = getAllUniversities();
    $output = "<table><tr><th>University Name</th></tr>";
    if(isset($universities) && $universities != null){
        foreach($universities as $i => $universityName) {
            $output .= "<tr><td>$universityName</td></tr>";
        }
    }

    $output .="</table>";
    return $output;
}

function getDepartments($universityName)
{
    $query = mysql_query("CALL getAllDepartments('$universityName')") or die(mysql_error());
    $result = null;
    $i = 0;
    while($row = mysql_fetch_array($query)) {
        $result[$i] = $row['departmentName'];
        $i++;
    }
    return $result;
}

function getTableWithAllDepartments($universityName) {
    $departments = getDepartments($universityName);
    $output = "<table><tr><th>Department Name</th></tr>";

    if(isset($departments) && $departments != null){
        foreach($departments as $i => $departmentName) {
            $output .= "<tr><td>$departmentName</td></tr>";
        }
    }

    $output .="</table>";
    return $output;
}

function generateDropDownList($data, $nameTag)
{
    $output = "<select name = '$nameTag'>";
    foreach ($data as $obj) {
        $output .= "<option value='$obj'>$obj</option>";
    }
    $output .= "</select>";

    return $output;
}

function addUniversity($universityName)
{
    $query = mysql_query("INSERT INTO university(universityName) VALUES('$universityName');") or die(mysql_error());
    return $query;
}

function renameUniversity($universityName, $newName)
{
    $query = mysql_query("UPDATE university SET universityName= '$newName' WHERE universityName = '$universityName'") or die(mysql_error());
    return $query;
}

function removeUniversity($universityName)
{
    $query = mysql_query("DELETE FROM university WHERE universityName='$universityName';") or die(mysql_error());
    return $query;
}


