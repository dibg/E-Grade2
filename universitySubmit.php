<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['universityName'])) {
                $universityName = $_POST['universityName'];
                addUniversity($universityName);
            }
        } elseif ($submit == 'rename') {
            if (isSetAndIsNotNull($_POST['selectedUniversity']) && isSetAndIsNotNull($_POST['universityName'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $universityName = $_POST['universityName'];
                renameUniversity($selectedUniversity, $universityName);
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedUniversity'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                removeUniversity($selectedUniversity);
            }
        }
    }
    //reloadPage();
}