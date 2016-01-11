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
        }
    }
} else {
    redirectTo("index.php");
}
