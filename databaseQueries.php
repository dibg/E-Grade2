<?php
include 'connection.php';

function loginAndRedirect($username, $password) {
    if (isset($username) && isset($password)) {
        $queryStudent =     mysqli_query($GLOBALS['dbLink'], "SELECT *  FROM student    WHERE studentUsername   = '$username' AND studentPassword    = ('$password')") or die(mysql_error());
        $queryProfessor =   mysqli_query($GLOBALS['dbLink'], "SELECT *  FROM professor  WHERE professorUsername = '$username' AND professorPassword  = ('$password')") or die(mysql_error());
        $querySecretary =   mysqli_query($GLOBALS['dbLink'], "SELECT *  FROM secretary  WHERE secretaryUsername = '$username' AND secretaryPassword  = ('$password')") or die(mysql_error());
        $queryAdmin =       mysqli_query($GLOBALS['dbLink'], "SELECT *  FROM admin      WHERE adminUsername     = '$username' AND adminPassword      = ('$password')") or die(mysql_error());

        $rowStudent = mysqli_fetch_assoc($queryStudent);
        $rowProfessor = mysqli_fetch_assoc($queryProfessor);
        $rowSecretary = mysqli_fetch_assoc($querySecretary);
        $rowAdmin = mysqli_fetch_assoc($queryAdmin);

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


function getStudentGrades($username) {
    $query = mysqli_query($GLOBALS['dbLink'], "CALL getStudentGrades('$username')") or die(mysql_error());

    $result = null;
    $i = 0;

    while($row = mysqli_fetch_assoc($query)) {
        $result[$i]['course'] = $row['courseName'];
        $result[$i]['gradeVal'] = $row['gradeVal'];
        $i++;
    }

    return $result;
}

function getAllUniversitiesNames() {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT universityName FROM university") or die(mysql_error());
    $result = null;
    $i = 0;
    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row['universityName'];
        $i++;
    }

    return $result;
}

function getAllUniversities() {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM university") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function getDepartmentsNames($universityName){
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT departmentName FROM university INNER JOIN department ON university.universityId = department.university_universityId WHERE universityName = '$universityName';") or die(mysql_error());
    $result = null;
    $i = 0;

    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row['departmentName'];
        $i++;
    }

    return $result;
}

function getDepartments($universityName){
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT departmentId, departmentName, university_universityId FROM university INNER JOIN department ON university.universityId = department.university_universityId WHERE universityName = '$universityName';") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}


function addUniversity($universityName){
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO university(universityName) VALUES('$universityName');") or die(mysql_error());

    return $query;
}

function renameUniversity($universityName, $newName){
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE university SET universityName= '$newName' WHERE universityName = '$universityName'") or die(mysql_error());

    return $query;
}

function removeUniversity($universityName){
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM university WHERE universityName='$universityName';") or die(mysql_error());

    return $query;
}

function getSecretaries($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM secretary WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addSecretary($username, $password, $departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO secretary(secretaryUsername, secretaryPassword, department_departmentId) VALUES('$username', '$password', $departmentId)") or die(mysql_error());

    return $query;
}

function removeSecretaryDepartmentId($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM secretary WHERE department_departmentId = $departmentId") or die(mysql_error());

    return $query;
}

function removeSecretary($secretaryId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM secretary WHERE secretaryId = $secretaryId") or die(mysql_error());

    return $query;
}

function changeSecretaryUsername($secretaryId, $username) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE secretary SET secretaryUsername = '$username' WHERE secretaryId = $secretaryId") or die(mysql_error());

    return $query;
}

function changeSecretaryPassword($secretaryId, $password) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE secretary SET secretaryPassword = '$password' WHERE secretaryId = $secretaryId") or die(mysql_error()); //todo

    return $query;
}

function addDepartment($universityName, $departmentName) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO department(departmentName, university_universityId) VALUES('$departmentName',(SELECT universityId FROM university WHERE universityName = '$universityName'))") or die(mysql_error());

    return $query;
}

function renameDepartment($selectedUniversity, $selectedDepartment, $newDepartmentName) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE department SET departmentName = '$newDepartmentName' WHERE departmentName = '$selectedDepartment' AND university_universityId = (SELECT universityId FROM university WHERE universityName = '$selectedUniversity')") or die(mysql_error());

    return $query;
}

function removeDepartment($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM department WHERE departmentId = $departmentId") or die(mysql_error());

    return $query;
}

function removeDepartmentSelectWithUniversityNameAndDepartmentName($selectedUniversity, $selectedDepartment) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM department WHERE departmentName='$selectedDepartment' AND university_universityId = (SELECT universityId FROM university WHERE universityName = '$selectedUniversity');") or die(mysql_error());

    return $query;
}

function transferDepartment($selectedDepartmentId, $transferToSelectedUniversityId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE department SET university_universityId = $transferToSelectedUniversityId WHERE departmentId = $selectedDepartmentId") or die(mysql_error());

    return $query;
}

function getProfessorsUsernames($universityName, $departmentName) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT professorUsername FROM professor INNER JOIN department ON professor.department_departmentId = department.departmentId INNER JOIN university WHERE universityName = '$universityName' and departmentName = '$departmentName'") or die(mysql_error());
    $result = null;
    $i = 0;
    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row['professorUsername'];
        $i++;
    }

    return $result;
}

function getProfessors($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM professor WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addProfessor($username, $password, $departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO professor(professorUsername, professorPassword, department_departmentId) VALUES ('$username', '$password', $departmentId)") or die(mysql_error());

    return $query;
}

function changeProfessor($username, $password, $professorId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE professor SET professorUsername = $username, professorPassword = $password WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function changeProfessorUsername($username, $professorId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE professor SET professorUsername = '$username' WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function changeProfessorPassword($password, $professorId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE professor SET professorPassword = '$password' WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function transferProfessor($professorId, $departmentIdTo) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE professor SET department_departmentId = $departmentIdTo WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function removeProfessor($professorId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM professor WHERE professorId = $professorId") or die(mysql_error());

    return $query;
}

function getStudents($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM student WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addStudent($username, $password, $departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO student(studentUsername, studentPassword, department_departmentId) VALUES ('$username', '$password', $departmentId)") or die(mysql_error());

    return $query;
}

function changeStudentUsername($username, $studentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE student SET studentUsername = '$username' WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function changeStudentPassword($password, $studentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE student SET studentPassword = '$password' WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function removeStudent($studentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM student WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function transferStudent($studentId, $departmentIdTo) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE student SET department_departmentId = $departmentIdTo WHERE studentId = $studentId") or die(mysql_error());

    return $query;
}

function getCourses($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM course WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addCourse($courseName, $departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO course(courseName, department_departmentId) VALUES ('$courseName', '$departmentId')") or die(mysql_error());

    return $query;
}

function removeCourse($courseId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM course WHERE courseId = $courseId") or die(mysql_error());

    return $query;
}

function renameCourse($courseName, $courseId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE course SET courseName = '$courseName' WHERE courseId = $courseId") or die(mysql_error());

    return $query;
}

function transferCourse($courseId, $departmentIdTo) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE course SET department_departmentId = $departmentIdTo WHERE courseId = $courseId") or die(mysql_error());

    return $query;
}

function getClasses($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM class WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addClass($className, $departmentId, $professorId, $courseId) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO class(className, department_departmentId, professor_professorId, course_courseId) VALUES ('$className', '$departmentId', '$professorId', '$courseId')") or die(mysql_error());

    return $query;
}

function assignClassProfessor($classId, $professorId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE class SET professor_professorId = '$professorId' WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function assignClassCourse($classId, $courseId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE class SET course_courseId = '$courseId' WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function removeClass($classId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM class WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function renameClass($className, $classId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE class SET className = '$className' WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function getGrades($departmentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM grade WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addGrade($gradeVal, $studentId, $courseId) {
    $query = mysqli_query($GLOBALS['dbLink'], "INSERT INTO grade(gradeVal, student_studentId, course_courseId) VALUES ('$gradeVal', '$studentId', $courseId)") or die(mysql_error());

    return $query;
}

function removeGrade($gradeId) {
    $query = mysqli_query($GLOBALS['dbLink'], "DELETE FROM grade WHERE gradeId = $gradeId") or die(mysql_error());

    return $query;
}

function changeGrade($gradeVal, $gradeId) {
    $query = mysqli_query($GLOBALS['dbLink'], "UPDATE grade SET gradeVal = $gradeVal WHERE gradeId = $gradeId") or die(mysql_error());

    return $query;
}

function getCoursesThatNotHaveGradeTheStudent($departmentId, $studentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM course WHERE courseId NOT IN(SELECT course_courseId FROM grade WHERE student_studentId = $studentId) AND course.department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function getCoursesThatHaveGradeTheStudent($departmentId, $studentId) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM course WHERE courseId IN(SELECT course_courseId FROM grade WHERE student_studentId = $studentId) AND course.department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function getGradeFromCourse($studentId, $courseID) {
    $query = mysqli_query($GLOBALS['dbLink'], "SELECT * FROM grade WHERE student_studentId = $studentId AND course_courseId = $courseID") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}