<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['courseName'])&& !empty($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $courseName = $_POST['courseName'];

                $isExecutedSuccessful = addCourse($courseName, $departmentId);
            }
        } else if ($submit == 'rename') {
            if (!empty($_POST['selectedCourseId'])) {
                $courseId = $_POST['selectedCourseId'];
                if(!empty($_POST['courseName'])){
                    $courseName = $_POST['courseName'];
                    $isExecutedSuccessful = renameCourse($courseName, $courseId);
                }
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedCourseId']) && !empty($_POST['selectedDepartmentIdTo'])) {
                $courseId = $_POST['selectedCourseId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                $isExecutedSuccessful = transferCourse($courseId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedCourseId'])) {
                $courseId = $_POST['selectedCourseId'];

                $isExecutedSuccessful = removeCourse($courseId);
            }
        }
    }
}

if(!empty($isExecutedSuccessful)) {
    echo queryStatusMessage($isExecutedSuccessful);
} else {
    echo emptyFormMessage();
}
?>