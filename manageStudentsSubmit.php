<?php
include 'functions.php';
$statusMessage = "Please fill all the form data.";

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['StudentUsername']) && !empty($_POST['StudentPassword']) && !empty($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $studentUsername = $_POST['StudentUsername'];
                $studentPassword = $_POST['StudentPassword'];

                $isExecutedSuccessful = addStudent($studentUsername, $studentPassword, $departmentId);
            }
        } else if ($submit == 'change') {
            if (!empty($_POST['selectedStudentId'])) {
                $studentId = $_POST['selectedStudentId'];
                if(!empty($_POST['studentUsername'])){
                    $studentUsername = $_POST['studentUsername'];
                    $isExecutedSuccessful = changestudentUsername($studentUsername, $studentId);
                }

                if(!empty($_POST['studentPassword'])){
                    $studentPassword = $_POST['studentPassword'];
                    $isExecutedSuccessful = changestudentPassword($studentPassword, $studentId);
                }
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedStudentId']) && !empty($_POST['selectedDepartmentIdTo'])) {
                $studentId = $_POST['selectedStudentId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                $isExecutedSuccessful = transferStudent($studentId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedStudentId'])) {
                $studentId = $_POST['selectedStudentId'];

                $isExecutedSuccessful = removeStudent($studentId);
            }
        }
    }
}

if(!empty($isExecutedSuccessful)){
    if($isExecutedSuccessful) $statusMessage = "";
    else $statusMessage = "Not Worked";
} else {
    $statusMessage = "Please fill all the form data.";
}
echo $statusMessage;

?>