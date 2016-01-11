<?php
include 'functions.php';

if(isSetAndIsNotNull($_POST['universityName'])){ //todo undefined variable
    $universityName = $_POST['universityName'];
    $dep = getDepartmentsNames($universityName);
    echo generateOptions($dep);
} else if(isSetAndIsNotNull($_POST['universityNameAndReturnDepartmentId'])) {
    $universityName = $_POST['universityNameAndReturnDepartmentId'];
    $dep = getDepartments($universityName);
    echo generateOptionsWithSpecifiedValueField($dep, 'departmentId', 'departmentName');
}