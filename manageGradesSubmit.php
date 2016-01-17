<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];
        if ($submit == 'add') {
            if (!empty($_POST['selectedStudentId']) && !empty($_POST['gradeValue']) && !empty($_POST['selectedCourseId'])) {
                $studentId = $_POST['selectedStudentId'];
                $gradeValue = $_POST['gradeValue'];
                $courseId = $_POST['selectedCourseId'];

                addGrade($gradeValue, $studentId, $courseId);
            }
        } else if ($submit == 'change') {
            if (!empty($_POST['selectedGradeId']) && !empty($_POST['gradeValue'])) {
                $gradeId = $_POST['selectedGradeId'];
                $gradeValue = $_POST['gradeValue'];


                changeGrade($gradeValue, $gradeId);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedGradeId'])) {
                $gradeId = $_POST['selectedGradeId'];

                removeGrade($gradeId);
            }
        }
    }
}

?>