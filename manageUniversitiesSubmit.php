<?php
include 'functions.php';

if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['universityName'])) {
                $universityName = $_POST['universityName'];
                $isExecutedSuccessful = addUniversity($universityName);
            }
        } elseif ($submit == 'rename') {
            if (!empty($_POST['selectedUniversity']) && !empty($_POST['universityName'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $universityName = $_POST['universityName'];
                $isExecutedSuccessful = renameUniversity($selectedUniversity, $universityName);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedUniversity'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $isExecutedSuccessful = removeUniversity($selectedUniversity);

            }
        }
    }
}

if(!empty($isExecutedSuccessful)){
    if($isExecutedSuccessful) $statusMessage = "";
    else $statusMessage = "Not Worked";
} else {
    $statusMessage = "Please fill all the form data.";
}
echo $statusMessage;

?>