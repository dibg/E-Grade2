<?php
$output_buffering=16653; // 16k should be enough for everyone.
ob_start();
session_start();
include 'connection.php';
include 'databaseQueries.php';

function loginAndRedirect($username, $password) {
    if (isset($username) && isset($password)) {
        $queryStudent =     mysql_query("SELECT *  FROM student    WHERE studentUsername   = '$username' AND studentPassword    = ('$password')") or die(mysql_error());
        $queryProfessor =   mysql_query("SELECT *  FROM professor  WHERE professorUsername = '$username' AND professorPassword  = ('$password')") or die(mysql_error());
        $querySecretary =   mysql_query("SELECT *  FROM secretary  WHERE secretaryUsername = '$username' AND secretaryPassword  = ('$password')") or die(mysql_error());
        $queryAdmin =       mysql_query("SELECT *  FROM admin      WHERE adminUsername     = '$username' AND adminPassword      = ('$password')") or die(mysql_error());

        $rowStudent = mysql_fetch_assoc($queryStudent);
        $rowProfessor = mysql_fetch_assoc($queryProfessor);
        $rowSecretary = mysql_fetch_assoc($querySecretary);
        $rowAdmin = mysql_fetch_assoc($queryAdmin);

        if(isset($rowStudent['studentUsername']) && isset($rowStudent['studentPassword'])){
            $_SESSION["user"] = $rowStudent['studentUsername'];
            $_SESSION["id"] = $rowStudent['studentId'];
            $_SESSION["departmentId"] = $rowStudent['department_departmentId'];
            $_SESSION["role"] = "STUDENT";
            redirectTo("student.php");
        } else if(isset($rowProfessor['professorUsername']) && isset($rowProfessor['professorPassword'])){
            $_SESSION["user"] = $rowProfessor['professorUsername'];
            $_SESSION["id"] = $rowProfessor['professorId'];
            $_SESSION["departmentId"] = $rowProfessor['department_departmentId'];
            $_SESSION["role"] = "PROFESSOR";
            redirectTo("professor.php");
        }else if(isset($rowSecretary['secretaryUsername']) && isset($rowSecretary["secretaryPassword"])){
            $_SESSION["user"] = $rowSecretary['secretaryUsername'];
            $_SESSION["id"] = $rowSecretary['secretaryId'];
            $_SESSION["departmentId"] = $rowSecretary['department_departmentId'];
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

function isLoginAsAdmin() {
    return $_SESSION["role"] == "ADMIN";
}

function isLoginAsSecretary() {
    return $_SESSION["role"] == "SECRETARY";
}

function isLoginAsProfessor() {
    return $_SESSION["role"] == "PROFESSOR";
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
    if(!empty($session)) {
        $role = $session['role'];
        if(sizeof($expectedRole) > 1) {
            if(!in_array($role, $expectedRole)) {
                redirectTo("accessDenied.php");
            }
        } else {
            if($role != $expectedRole) {
                redirectTo("accessDenied.php");
            }
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
    printf('
    <script>
        $(document).ready(function(){
            $(\'%s\').fadeOut(%d
             );
        });
    </script>
    ', $element, $milliseconds);
}

function loginMessageHandler () {
    if(isset($_GET['login'])){
        if($_GET['login'] == 'failed'){
            fadeOut("h2", 3000);
            echo "<h2 class='warning'>The credentials is incorrect please try again.</h2>";
        } else if ($_GET['login'] == 'admin') {
            fadeOut("h2", 3000);
            echo "<h2 class='warning'>Very Funny.</h2>";
        } else if ($_GET['login'] == 'logout') {
            fadeOut("h2", 3000);
            echo "<h2 class='success'>Successful logout.</h2>";
        }
    }
}

function getTableWithStudentGrades($username) {
    $grades = getStudentGrades($username);
    $output = "<table align='center'><tr><th>Course</th><th>Grade</th></tr>";
    if(isset($grades) && $grades != null){
        foreach($grades as $i => $obj) {
            $course = $obj['course'];
            $grade = $obj['gradeVal'];

            $output .= "<tr><td>$course</td><td>$grade</td></tr>";
        }
    }
    $output .="</table>";

    return $output;
}

function generateTableWithAllUniversitiesNames(){
    $universities = getAllUniversitiesNames();
    $output = "<table><tr><th>University Name</th></tr>";
    if(isset($universities) && $universities != null){
        foreach($universities as $i => $universityName) {
            $output .= "<tr><td>$universityName</td></tr>";
        }
    }
    $output .="</table>";

    return $output;
}

function getTableWithAllDepartments($universityName) {
    $departments = getDepartmentsNames($universityName);
    $output = "<table><tr><th>Department Name</th></tr>";

    if(isset($departments) && $departments != null){
        foreach($departments as $i => $departmentName) {
            $output .= "<tr><td>$departmentName</td></tr>";
        }
    }
    $output .="</table>";

    return $output;
}

function generateDropDownList($data, $nameTag, $classTag="none", $idTag="none"){
    $output = "<select name='$nameTag'";
    if($classTag != "none"){
        $output .= " class='$classTag'";
    }
    if($idTag != "none"){
        $output .= " id='$idTag'";
    }
    $output .= ">";
    $output .= generateOptions($data);
    $output .= "</select>";

    return $output;
}

function generateDropDownListWithFirstOption($data, $firstOption, $nameTag, $idTag="none"){
    $output = "<select name='$nameTag'";
    if($idTag != "none"){
        $output .= " id='$idTag'";
    }
    $output .= ">";
    $output .= "<option value=''>$firstOption</option>";
    $output .= generateOptions($data);
    $output .= "</select>";

    return $output;
}

function generateDropDownListWithFirstOptionAndSpecifiedValueKey($data, $firstOption, $nameTag, $idTag, $valueKey, $nameKey){
    $output = "<select name='$nameTag'";
    $output .= " id='$idTag'";
    $output .= ">";
    $output .= "<option value=''>$firstOption</option>";
    $output .= generateOptionsWithSpecifiedValueField($data, $valueKey, $nameKey);
    $output .= "</select>";

    return $output;
}

function generateDropDownListWithSpecifiedValueKey($data, $nameTag, $idTag, $valueKey, $nameKey){
    $output = "<select name='$nameTag'";
    $output .= " id='$idTag'";
    $output .= ">";
    $output .= generateOptionsWithSpecifiedValueField($data, $valueKey, $nameKey);
    $output .= "</select>";

    return $output;
}

function generateOptions($data) {
    $output = "";

    if(!empty($data)) {
        foreach ($data as $obj) {
            $output .= "<option value='$obj'>$obj</option>";
        }
    }

    return $output;
}

function generateOptionsWithSpecifiedValueField($data, $valueKey, $nameKey) {
    $output = "";

    if(!empty($data)) {
        foreach ($data as $obj) {
            $output .= "<option value='$obj[$valueKey]'>$obj[$nameKey]</option>";
        }
    }

    return $output;
}

function reloadPage() {
    header("Refresh:0");
}

function getAllRows($query) {
    $result = null;
    $i = 0;
    while($row = mysql_fetch_array($query)) {
        $result[$i] = $row;
        $i++;
    }

    return $result;
}

function isSetAndIsNotNull($var) {
    return (isset($var) && $var != null);
}
