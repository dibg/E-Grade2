<?php
include 'functions.php';

if(isSetAndIsNotNull($_POST['universityName'])){
    $universityName = $_POST['universityName'];
    $dep = getDepartments($universityName);
    echo generateOptions($dep);
}