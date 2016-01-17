<?php
$output_buffering=16653; // 16k should be enough for everyone.
ob_start();
session_start();
include 'databaseQueries.php';

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
    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row;
        $i++;
    }

    return $result;
}

function isSetAndIsNotNull($var) {
    return (isset($var) && $var != null);
}

function query($query){
    $results = mysqli_query($GLOBALS['dbLink'], $query) or die(mysql_error());

    return $results;
}

?>