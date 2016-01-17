<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['courseName'])&& !empty($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $courseName = $_POST['courseName'];

                addCourse($courseName, $departmentId);
            }
        } else if ($submit == 'rename') {
            if (!empty($_POST['selectedCourseId'])) {
                $courseId = $_POST['selectedCourseId'];
                if(!empty($_POST['courseName'])){
                    $courseName = $_POST['courseName'];
                    renameCourse($courseName, $courseId);
                }
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedCourseId']) && !empty($_POST['selectedDepartmentIdTo'])) {
                $courseId = $_POST['selectedCourseId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                transferCourse($courseId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedCourseId'])) {
                $courseId = $_POST['selectedCourseId'];

                removeCourse($courseId);
            }
        }
    }
}

?>