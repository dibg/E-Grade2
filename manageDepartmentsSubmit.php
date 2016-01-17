<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['departmentName']) && !empty($_POST['selectedUniversity']) && !empty($_POST['secretaryUsername']) && !empty($_POST['secretaryUsername'])) {
                $departmentName = $_POST['departmentName'];
                $selectedUniversity = $_POST['selectedUniversity'];
                $secretaryUsername = $_POST['secretaryUsername'];
                $secretaryPassword = $_POST['secretaryPassword'];

                addDepartment($selectedUniversity, $departmentName);
                $departmentId = mysqli_insert_id($GLOBALS['dbLink']);
                $isExecutedSuccessful = addSecretary($secretaryUsername, $secretaryPassword, $departmentId);
            }
        } else if ($submit == 'rename') {
            if (!empty($_POST['selectedUniversity']) && !empty($_POST['selectedDepartment']) && !empty($_POST['departmentName']) ) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $selectedDepartment = $_POST['selectedDepartment'];
                $departmentName = $_POST['departmentName'];

                $isExecutedSuccessful = renameDepartment($selectedUniversity, $selectedDepartment, $departmentName);
            }
        } else if ($submit == 'change') {
            if (!empty($_POST['selectedDepartmentId']) && !empty($_POST['selectedSecretaryId']) ) {
                $selectedDepartmentId = $_POST['selectedDepartmentId'];
                $secretaryId = $_POST['selectedSecretaryId'];

                if(!empty($_POST['secretaryUsername'])) {
                    $username = $_POST['secretaryUsername'];
                    $isExecutedSuccessful = changeSecretaryUsername($secretaryId, $username);
                }
                if(!empty($_POST['SecretaryPassword'])) {
                    $password = $_POST['SecretaryPassword'];
                    $isExecutedSuccessful = changeSecretaryPassword($secretaryId, $password);
                }
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedDepartmentId'])) {
                $selectedDepartmentId = $_POST['selectedDepartmentId'];

                removeSecretaryDepartmentId($selectedDepartmentId);
                $isExecutedSuccessful = removeDepartment($selectedDepartmentId);
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedDepartmentId']) && !empty($_POST['transferToSelectedUniversityId'])) {
                $selectedDepartmentId = $_POST['selectedDepartmentId'];
                $transferToSelectedUniversityId = $_POST['transferToSelectedUniversityId'];
                $isExecutedSuccessful = transferDepartment($selectedDepartmentId, $transferToSelectedUniversityId);
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