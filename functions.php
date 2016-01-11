<?php
$output_buffering=16653; // 16k should be enough for everyone.
ob_start();
session_start();
include 'connection.php';

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
    if(isSetAndIsNotNull($session)) {
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

function getStudentGrades($username) {
    $query = mysql_query("CALL getStudentGrades('$username')") or die(mysql_error());

    $result = null;
    $i = 0;

    while($row = mysql_fetch_assoc($query)) {
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

function getAllUniversitiesNames() {
    $query = mysql_query("SELECT universityName FROM university") or die(mysql_error());
    $result = null;
    $i = 0;
    while($row = mysql_fetch_assoc($query)) {
        $result[$i] = $row['universityName'];
        $i++;
    }

    return $result;
}

function getAllUniversities() {
    $query = mysql_query("SELECT * FROM university") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
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

function getDepartmentsNames($universityName){
    $query = mysql_query("SELECT departmentName FROM university INNER JOIN department ON university.universityId = department.university_universityId WHERE universityName = '$universityName';") or die(mysql_error());
    $result = null;
    $i = 0;

    while($row = mysql_fetch_assoc($query)) {
        $result[$i] = $row['departmentName'];
        $i++;
    }

    return $result;
}

function getDepartments($universityName){
    $query = mysql_query("SELECT departmentId, departmentName, university_universityId FROM university INNER JOIN department ON university.universityId = department.university_universityId WHERE universityName = '$universityName';") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
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

    if(isSetAndIsNotNull($data)) {
        foreach ($data as $obj) {
            $output .= "<option value='$obj'>$obj</option>";
        }
    }

    return $output;
}

function generateOptionsWithSpecifiedValueField($data, $valueKey, $nameKey) {
    $output = "";

    if(isSetAndIsNotNull($data)) {
        foreach ($data as $obj) {
            $output .= "<option value='$obj[$valueKey]'>$obj[$nameKey]</option>";
        }
    }

    return $output;
}

function addUniversity($universityName){
    $query = mysql_query("INSERT INTO university(universityName) VALUES('$universityName');") or die(mysql_error());

    return $query;
}

function renameUniversity($universityName, $newName){
    $query = mysql_query("UPDATE university SET universityName= '$newName' WHERE universityName = '$universityName'") or die(mysql_error());

    return $query;
}

function removeUniversity($universityName){
    $query = mysql_query("DELETE FROM university WHERE universityName='$universityName';") or die(mysql_error());

    return $query;
}

function isSetAndIsNotNull($var) {
    return (isset($var) && $var != null);
}

function reloadPage() {
    header("Refresh:0");
}

function getSecretaries($departmentId) {
    $query = mysql_query("SELECT * FROM secretary WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addSecretary($username, $password, $departmentId) {
    $query = mysql_query("INSERT INTO secretary(secretaryUsername, secretaryPassword, department_departmentId) VALUES('$username', '$password', $departmentId)") or die(mysql_error());

    return $query;
}

function removeSecretaryDepartmentId($departmentId) {
    $query = mysql_query("DELETE FROM secretary WHERE department_departmentId = $departmentId") or die(mysql_error());

    return $query;
}

function removeSecretary($secretaryId) {
    $query = mysql_query("DELETE FROM secretary WHERE secretaryId = $secretaryId") or die(mysql_error());

    return $query;
}

function changeSecretaryUsername($secretaryId, $username) {
    $query = mysql_query("UPDATE secretary SET secretaryUsername = '$username' WHERE secretaryId = $secretaryId") or die(mysql_error());

    return $query;
}

function changeSecretaryPassword($secretaryId, $password) {
    $query = mysql_query("UPDATE secretary SET secretaryPassword = '$password' WHERE secretaryId = $secretaryId") or die(mysql_error()); //todo

    return $query;
}

function addDepartment($universityName, $departmentName) {
    $query = mysql_query("INSERT INTO department(departmentName, university_universityId) VALUES('$departmentName',(SELECT universityId FROM university WHERE universityName = '$universityName'))") or die(mysql_error());

    return $query;
}

function renameDepartment($selectedUniversity, $selectedDepartment, $newDepartmentName) {
    $query = mysql_query("UPDATE department SET departmentName = '$newDepartmentName' WHERE departmentName = '$selectedDepartment' AND university_universityId = (SELECT universityId FROM university WHERE universityName = '$selectedUniversity')") or die(mysql_error());

    return $query;
}

function removeDepartment($departmentId) {
    $query = mysql_query("DELETE FROM department WHERE departmentId = $departmentId") or die(mysql_error());

    return $query;
}

function removeDepartmentSelectWithUniversityNameAndDepartmentName($selectedUniversity, $selectedDepartment) {
    $query = mysql_query("DELETE FROM department WHERE departmentName='$selectedDepartment' AND university_universityId = (SELECT universityId FROM university WHERE universityName = '$selectedUniversity');") or die(mysql_error());

    return $query;
}

function transferDepartment($selectedDepartmentId, $transferToSelectedUniversityId) {
    $query = mysql_query("UPDATE department SET university_universityId = $transferToSelectedUniversityId WHERE departmentId = $selectedDepartmentId") or die(mysql_error());

    return $query;
}

function getProfessorsUsernames($universityName, $departmentName) {
    $query = mysql_query("SELECT professorUsername FROM professor INNER JOIN department ON professor.department_departmentId = department.departmentId INNER JOIN university WHERE universityName = '$universityName' and departmentName = '$departmentName'") or die(mysql_error());
    $result = null;
    $i = 0;
    while($row = mysql_fetch_array($query)) {
        $result[$i] = $row['professorUsername'];
        $i++;
    }

    return $result;
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

function getProfessors($departmentId) {
    $query = mysql_query("SELECT * FROM professor WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addProfessor($username, $password, $departmentId) {
    $query = mysql_query("INSERT INTO professor(professorUsername, professorPassword, department_departmentId) VALUES ('$username', '$password', $departmentId)") or die(mysql_error());

    return $query;
}

function changeProfessor($username, $password, $professorId) {
    $query = mysql_query("UPDATE professor SET professorUsername = $username, professorPassword = $password WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function changeProfessorUsername($username, $professorId) {
    $query = mysql_query("UPDATE professor SET professorUsername = '$username' WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function changeProfessorPassword($password, $professorId) {
    $query = mysql_query("UPDATE professor SET professorPassword = '$password' WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function transferProfessor($professorId, $departmentIdTo) {
    $query = mysql_query("UPDATE professor SET department_departmentId = $departmentIdTo WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function removeProfessor($professorId) {
    $query = mysql_query("DELETE FROM professor WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function getStudents($departmentId) {
    $query = mysql_query("SELECT * FROM student WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addStudent($username, $password, $departmentId) {
    $query = mysql_query("INSERT INTO student(studentUsername, studentPassword, department_departmentId) VALUES ('$username', '$password', $departmentId)") or die(mysql_error());

    return $query;
}

function changeStudentUsername($username, $studentId) {
    $query = mysql_query("UPDATE student SET studentUsername = '$username' WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function changeStudentPassword($password, $studentId) {
    $query = mysql_query("UPDATE student SET studentPassword = '$password' WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function removeStudent($studentId) {
    $query = mysql_query("DELETE FROM student WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function transferStudent($studentId, $departmentIdTo) {
    $query = mysql_query("UPDATE student SET department_departmentId = $departmentIdTo WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function getCourses($departmentId) {
    $query = mysql_query("SELECT * FROM course WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addCourse($courseName, $departmentId) {
    $query = mysql_query("INSERT INTO course(courseName, department_departmentId) VALUES ('$courseName', '$departmentId')") or die(mysql_error());

    return $query;
}

function removeCourse($courseId) {
    $query = mysql_query("DELETE FROM course WHERE courseId = $courseId") or die(mysql_error());

    return $query;
}

function renameCourse($courseName, $courseId) {
    $query = mysql_query("UPDATE course SET courseName = '$courseName' WHERE courseId = $courseId") or die(mysql_error());

    return $query;
}

function transferCourse($courseId, $departmentIdTo) {
    $query = mysql_query("UPDATE course SET department_departmentId = $departmentIdTo WHERE courseId = $courseId") or die(mysql_error());

    return $query;

}

