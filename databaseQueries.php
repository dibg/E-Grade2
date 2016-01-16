<?php
function getStudentGrades($username) {
    $query = mysql_query("CALL getStudentGrades('$username')") or die(mysql_error());

    $result = null;
    $i = 0;

    while($row = mysql_fetch_assoc($query)) {
        $result[$i]['course'] = $row['courseName'];
        $result[$i]['gradeVal'] = $row['gradeVal'];
        $i++;
    }

    return $result;
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

function getClasses($departmentId) {
    $query = mysql_query("SELECT * FROM class WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addClass($className, $departmentId, $professorId, $courseId) {
    $query = mysql_query("INSERT INTO class(className, department_departmentId, professor_professorId, course_courseId) VALUES ('$className', '$departmentId', '$professorId', '$courseId')") or die(mysql_error());

    return $query;
}

function assignClassProfessor($classId, $professorId) {
    $query = mysql_query("UPDATE class SET professor_professorId = '$professorId' WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function assignClassCourse($classId, $courseId) {
    $query = mysql_query("UPDATE class SET course_courseId = '$courseId' WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function removeClass($classId) {
    $query = mysql_query("DELETE FROM class WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function renameClass($className, $classId) {
    $query = mysql_query("UPDATE class SET className = '$className' WHERE classId = $classId") or die(mysql_error());

    return $query;
}

function getGrades($departmentId) {
    $query = mysql_query("SELECT * FROM grade WHERE department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function addGrade($gradeVal, $studentId, $courseId) {
    $query = mysql_query("INSERT INTO grade(gradeVal, student_studentId, course_courseId) VALUES ('$gradeVal', '$studentId', $courseId)") or die(mysql_error());

    return $query;
}

function removeGrade($gradeId) {
    $query = mysql_query("DELETE FROM grade WHERE gradeId = $gradeId") or die(mysql_error());

    return $query;
}

function changeGrade($gradeVal, $gradeId) {
    $query = mysql_query("UPDATE grade SET gradeVal = $gradeVal WHERE gradeId = $gradeId") or die(mysql_error());

    return $query;
}

function getCoursesThatNotHaveGradeTheStudent($departmentId, $studentId) {
    $query = mysql_query("SELECT * FROM course WHERE courseId NOT IN(SELECT course_courseId FROM grade WHERE student_studentId = $studentId) AND course.department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function getCoursesThatHaveGradeTheStudent($departmentId, $studentId) {
    $query = mysql_query("SELECT * FROM course WHERE courseId IN(SELECT course_courseId FROM grade WHERE student_studentId = $studentId) AND course.department_departmentId = $departmentId") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}

function getGradeFromCourse($studentId, $courseID) {
    $query = mysql_query("SELECT * FROM grade WHERE student_studentId = $studentId AND course_courseId = $courseID") or die(mysql_error());
    $result = getAllRows($query);

    return $result;
}
?>
