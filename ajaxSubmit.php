<?php
include 'functions.php';

if (isSetAndIsNotNull($_POST)) {
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'universityName':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $universityName = $_POST[$key];
                    $dep = getDepartmentsNames($universityName);
                    echo generateOptions($dep);
                }
                break;
            case 'universityNameAndReturnDepartmentId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $universityName = $_POST[$key];
                    $dep = getDepartments($universityName);
                    echo generateOptionsWithSpecifiedValueField($dep, 'departmentId', 'departmentName');
                }
                break;
            case 'departmentIdAndReturnProfessorId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $departmentId = $_POST[$key];
                    $pro = getProfessors($departmentId);
                    echo generateOptionsWithSpecifiedValueField($pro, 'professorId', 'professorUsername');
                }
                break;
            case 'departmentIdAndReturnSecretaryId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $departmentId = $_POST[$key];
                    $sec = getSecretaries($departmentId);
                    echo generateOptionsWithSpecifiedValueField($sec, 'secretaryId', 'secretaryUsername');
                }
                break;
            case 'departmentIdAndReturnStudentId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $departmentId = $_POST[$key];
                    $stu = getStudents($departmentId);
                    echo generateOptionsWithSpecifiedValueField($stu, 'studentId', 'studentUsername');
                }
                break;
            case 'departmentIdAndReturnCourseId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $departmentId = $_POST[$key];
                    $cou = getCourses($departmentId);
                    echo generateOptionsWithSpecifiedValueField($cou, 'courseId', 'courseName');
                }
                break;
            case 'departmentIdAndReturnClassId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $departmentId = $_POST[$key];
                    $cla = getClasses($departmentId);
                    echo generateOptionsWithSpecifiedValueField($cla, 'classId', 'className');
                }
                break;
            case 'courseIdAndReturnGradeId':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $departmentId = $_POST[$key];
                    $gra = getClasses($departmentId);
                    echo generateOptionsWithSpecifiedValueField($gra, 'gradeId', 'gradeVal');
                }
                break;
            case 'studentIdAndReturnCourseIdThatNotHaveGrade':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $studentId = $_POST[$key];
                    $departmentId = $_POST['departmentIdAndReturnCourseIdThatNotHaveGrade'];
                    $cou = getCoursesThatNotHaveGradeTheStudent($departmentId, $studentId);
                    echo generateOptionsWithSpecifiedValueField($cou, 'courseId', 'courseName');
                }
                break;
            case 'studentIdAndReturnCourseIdThatHaveGrade':
                if (isSetAndIsNotNull($_POST[$key])) {
                    $studentId = $_POST[$key];
                    $departmentId = $_POST['departmentIdAndReturnCourseIdThatHaveGrade'];
                    $cou = getCoursesThatHaveGradeTheStudent($departmentId, $studentId);
                    echo generateOptionsWithSpecifiedValueField($cou, 'courseId', 'courseName');
                }
                break;

        }
    }
} else {
    redirectTo("index.php");
}
