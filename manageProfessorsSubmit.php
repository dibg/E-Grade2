<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['professorPassword']) && !empty($_POST['professorUsername'])&& !empty($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $professorUsername = $_POST['professorUsername'];
                $professorPassword = $_POST['professorPassword'];

                $isExecutedSuccessful = addProfessor($professorUsername, $professorPassword, $departmentId);
            }
        } else if ($submit == 'change') {
            if (!empty($_POST['selectedProfessorId'])) {
                $professorId = $_POST['selectedProfessorId'];
                if(!empty($_POST['professorUsername'])){
                    $professorUsername = $_POST['professorUsername'];
                    $isExecutedSuccessful =  changeProfessorUsername($professorUsername, $professorId);
                }

                if(!empty($_POST['professorPassword'])){
                    $professorPassword = $_POST['professorPassword'];
                    $isExecutedSuccessful = changeProfessorPassword($professorPassword, $professorId);
                }
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedProfessorId']) && !empty($_POST['selectedDepartmentIdTo'])) {
                $professorId = $_POST['selectedProfessorId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                $isExecutedSuccessful = transferProfessor($professorId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedProfessorId'])) {
                $professorId = $_POST['selectedProfessorId'];

                $isExecutedSuccessful = removeProfessor($professorId);
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