<?php
include 'functions.php';
//var_dump($_POST);

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['universityName'])) {
                $universityName = $_POST['universityName'];
                addUniversity($universityName);
            }
        } elseif ($submit == 'rename') {
            if (!empty($_POST['selectedUniversity']) && !empty($_POST['universityName'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $universityName = $_POST['universityName'];
                renameUniversity($selectedUniversity, $universityName);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedUniversity'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                removeUniversity($selectedUniversity);
            }
        }
    }
}

?>