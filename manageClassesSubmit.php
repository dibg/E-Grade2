<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['className'])&& !empty($_POST['selectedDepartmentId']) &&
                !empty($_POST['selectedProfessorId']) && !empty($_POST['selectedCourseId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $className = $_POST['className'];
                $professorId = $_POST['selectedProfessorId'];
                $courseId = $_POST['selectedCourseId'];

                $isExecutedSuccessful = addClass($className, $departmentId, $professorId, $courseId);
            }
        } else if ($submit == 'rename') {
            if (!empty($_POST['selectedClassId'])) {
                $classId = $_POST['selectedClassId'];
                if(!empty($_POST['className'])){
                    $className = $_POST['className'];
                    $isExecutedSuccessful =  renameClass($className, $classId);
                }
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedClassId'])) {
                $classId = $_POST['selectedClassId'];

                $isExecutedSuccessful = removeClass($classId);
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
