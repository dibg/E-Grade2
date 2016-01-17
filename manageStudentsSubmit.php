<?php
include 'functions.php';
var_dump($_POST);

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['StudentUsername']) && !empty($_POST['StudentPassword']) && !empty($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $studentUsername = $_POST['StudentUsername'];
                $studentPassword = $_POST['StudentPassword'];

                addStudent($studentUsername, $studentPassword, $departmentId);
            }
        } else if ($submit == 'change') {
            if (!empty($_POST['selectedStudentId'])) {
                $studentId = $_POST['selectedStudentId'];
                if(!empty($_POST['studentUsername'])){
                    $studentUsername = $_POST['studentUsername'];
                    changestudentUsername($studentUsername, $studentId);
                }

                if(!empty($_POST['studentPassword'])){
                    $studentPassword = $_POST['studentPassword'];
                    changestudentPassword($studentPassword, $studentId);
                }
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedStudentId']) && !empty($_POST['selectedDepartmentIdTo'])) {
                $studentId = $_POST['selectedStudentId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                transferStudent($studentId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedStudentId'])) {
                $studentId = $_POST['selectedStudentId'];

                removeStudent($studentId);
            }
        }
    }
}
?>