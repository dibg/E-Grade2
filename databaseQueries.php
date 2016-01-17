<?php
include 'connection.php';

function loginAndRedirect($username, $password) {
    if (isset($username) && isset($password)) {
        $queryStudent =     query("SELECT *  FROM student    WHERE studentUsername   = '$username' AND studentPassword    = ('$password')");
        $queryProfessor =   query("SELECT *  FROM professor  WHERE professorUsername = '$username' AND professorPassword  = ('$password')");
        $querySecretary =   query("SELECT *  FROM secretary  WHERE secretaryUsername = '$username' AND secretaryPassword  = ('$password')");
        $queryAdmin =       query("SELECT *  FROM admin      WHERE adminUsername     = '$username' AND adminPassword      = ('$password')");

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
    $query = query("CALL getStudentGrades('$username')");

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
    $query = query("SELECT universityName FROM university");
    $result = null;
    $i = 0;
    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row['universityName'];
        $i++;
    }

    return $result;
}

function getAllUniversities() {
    $query = query("SELECT * FROM university");
    $result = getAllRows($query);

    return $result;
}

function getDepartmentsNames($universityName){
    $query = query("SELECT departmentName FROM university INNER JOIN department ON university.universityId = department.university_universityId WHERE universityName = '$universityName';");
    $result = null;
    $i = 0;

    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row['departmentName'];
        $i++;
    }

    return $result;
}

function getDepartments($universityName){
    $query = query("SELECT departmentId, departmentName, university_universityId FROM university INNER JOIN department ON university.universityId = department.university_universityId WHERE universityName = '$universityName';");
    $result = getAllRows($query);

    return $result;
}


function addUniversity($universityName){
    $query = query("INSERT INTO university(universityName) VALUES('$universityName');");

    return $query;
}

function renameUniversity($universityName, $newName){
    $query = query("UPDATE university SET universityName= '$newName' WHERE universityName = '$universityName'");

    return $query;
}

function removeUniversity($universityName){
    $query = query("DELETE FROM university WHERE universityName='$universityName';");

    return $query;
}

function getSecretaries($departmentId) {
    $query = query("SELECT * FROM secretary WHERE department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function addSecretary($username, $password, $departmentId) {
    $query = query("INSERT INTO secretary(secretaryUsername, secretaryPassword, department_departmentId) VALUES('$username', '$password', $departmentId)");

    return $query;
}

function removeSecretaryDepartmentId($departmentId) {
    $query = query("DELETE FROM secretary WHERE department_departmentId = $departmentId");

    return $query;
}

function removeSecretary($secretaryId) {
    $query = query("DELETE FROM secretary WHERE secretaryId = $secretaryId");

    return $query;
}

function changeSecretaryUsername($secretaryId, $username) {
    $query = query("UPDATE secretary SET secretaryUsername = '$username' WHERE secretaryId = $secretaryId");

    return $query;
}

function changeSecretaryPassword($secretaryId, $password) {
    $query = query("UPDATE secretary SET secretaryPassword = '$password' WHERE secretaryId = $secretaryId"); //todo

    return $query;
}

function addDepartment($universityName, $departmentName) {
    $query = query("INSERT INTO department(departmentName, university_universityId) VALUES('$departmentName',(SELECT universityId FROM university WHERE universityName = '$universityName'))");

    return $query;
}

function renameDepartment($selectedUniversity, $selectedDepartment, $newDepartmentName) {
    $query = query("UPDATE department SET departmentName = '$newDepartmentName' WHERE departmentName = '$selectedDepartment' AND university_universityId = (SELECT universityId FROM university WHERE universityName = '$selectedUniversity')");

    return $query;
}

function removeDepartment($departmentId) {
    $query = query("DELETE FROM department WHERE departmentId = $departmentId");

    return $query;
}

function removeDepartmentSelectWithUniversityNameAndDepartmentName($selectedUniversity, $selectedDepartment) {
    $query = query("DELETE FROM department WHERE departmentName='$selectedDepartment' AND university_universityId = (SELECT universityId FROM university WHERE universityName = '$selectedUniversity');");

    return $query;
}

function transferDepartment($selectedDepartmentId, $transferToSelectedUniversityId) {
    $query = query("UPDATE department SET university_universityId = $transferToSelectedUniversityId WHERE departmentId = $selectedDepartmentId");

    return $query;
}

function getProfessorsUsernames($universityName, $departmentName) {
    $query = query("SELECT professorUsername FROM professor INNER JOIN department ON professor.department_departmentId = department.departmentId INNER JOIN university WHERE universityName = '$universityName' and departmentName = '$departmentName'");
    $result = null;
    $i = 0;
    while($row = mysqli_fetch_assoc($query)) {
        $result[$i] = $row['professorUsername'];
        $i++;
    }

    return $result;
}

function getProfessors($departmentId) {
    $query = query("SELECT * FROM professor WHERE department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function addProfessor($username, $password, $departmentId) {
    $query = query("INSERT INTO professor(professorUsername, professorPassword, department_departmentId) VALUES ('$username', '$password', $departmentId)");

    return $query;
}

function changeProfessor($username, $password, $professorId) {
    $query = query("UPDATE professor SET professorUsername = $username, professorPassword = $password WHERE professorId = $professorId");

    return $query;
}

function changeProfessorUsername($username, $professorId) {
    $query = query("UPDATE professor SET professorUsername = '$username' WHERE professorId = $professorId");

    return $query;
}

function changeProfessorPassword($password, $professorId) {
    $query = query("UPDATE professor SET professorPassword = '$password' WHERE professorId = $professorId");

    return $query;
}

function transferProfessor($professorId, $departmentIdTo) {
    $query = query("UPDATE professor SET department_departmentId = $departmentIdTo WHERE professorId = $professorId");

    return $query;
}

function removeProfessor($professorId) {
    $query = query("DELETE FROM professor WHERE professorId = $professorId");

    return $query;
}

function getStudents($departmentId) {
    $query = query("SELECT * FROM student WHERE department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function addStudent($username, $password, $departmentId) {
    $query = query("INSERT INTO student(studentUsername, studentPassword, department_departmentId) VALUES ('$username', '$password', $departmentId)");

    return $query;
}

function changeStudentUsername($username, $studentId) {
    $query = query("UPDATE student SET studentUsername = '$username' WHERE studentId = $studentId");

    return $query;
}

function changeStudentPassword($password, $studentId) {
    $query = query("UPDATE student SET studentPassword = '$password' WHERE studentId = $studentId");

    return $query;
}

function removeStudent($studentId) {
    $query = query("DELETE FROM student WHERE studentId = $studentId");

    return $query;
}

function transferStudent($studentId, $departmentIdTo) {
    $query = query("UPDATE student SET department_departmentId = $departmentIdTo WHERE studentId = $studentId");

    return $query;
}

function getCourses($departmentId) {
    $query = query("SELECT * FROM course WHERE department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function addCourse($courseName, $departmentId) {
    $query = query("INSERT INTO course(courseName, department_departmentId) VALUES ('$courseName', '$departmentId')");

    return $query;
}

function removeCourse($courseId) {
    $query = query("DELETE FROM course WHERE courseId = $courseId");

    return $query;
}

function renameCourse($courseName, $courseId) {
    $query = query("UPDATE course SET courseName = '$courseName' WHERE courseId = $courseId");

    return $query;
}

function transferCourse($courseId, $departmentIdTo) {
    $query = query("UPDATE course SET department_departmentId = $departmentIdTo WHERE courseId = $courseId");

    return $query;
}

function getClasses($departmentId) {
    $query = query("SELECT * FROM class WHERE department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function addClass($className, $departmentId, $professorId, $courseId) {
    $query = query("INSERT INTO class(className, department_departmentId, professor_professorId, course_courseId) VALUES ('$className', '$departmentId', '$professorId', '$courseId')");

    return $query;
}

function assignClassProfessor($classId, $professorId) {
    $query = query("UPDATE class SET professor_professorId = '$professorId' WHERE classId = $classId");

    return $query;
}

function assignClassCourse($classId, $courseId) {
    $query = query("UPDATE class SET course_courseId = '$courseId' WHERE classId = $classId");

    return $query;
}

function removeClass($classId) {
    $query = query("DELETE FROM class WHERE classId = $classId");

    return $query;
}

function renameClass($className, $classId) {
    $query = query("UPDATE class SET className = '$className' WHERE classId = $classId");

    return $query;
}

function getGrades($departmentId) {
    $query = query("SELECT * FROM grade WHERE department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function addGrade($gradeVal, $studentId, $courseId) {
    $query = query("INSERT INTO grade(gradeVal, student_studentId, course_courseId) VALUES ('$gradeVal', '$studentId', $courseId)");

    return $query;
}

function removeGrade($gradeId) {
    $query = query("DELETE FROM grade WHERE gradeId = $gradeId");

    return $query;
}

function changeGrade($gradeVal, $gradeId) {
    $query = query("UPDATE grade SET gradeVal = $gradeVal WHERE gradeId = $gradeId");

    return $query;
}

function getCoursesThatNotHaveGradeTheStudent($departmentId, $studentId) {
    $query = query("SELECT * FROM course WHERE courseId NOT IN(SELECT course_courseId FROM grade WHERE student_studentId = $studentId) AND course.department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function getCoursesThatHaveGradeTheStudent($departmentId, $studentId) {
    $query = query("SELECT * FROM course WHERE courseId IN(SELECT course_courseId FROM grade WHERE student_studentId = $studentId) AND course.department_departmentId = $departmentId");
    $result = getAllRows($query);

    return $result;
}

function getGradeFromCourse($studentId, $courseID) {
    $query = query("SELECT * FROM grade WHERE student_studentId = $studentId AND course_courseId = $courseID");
    $result = getAllRows($query);

    return $result;
}