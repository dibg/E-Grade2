<?php
    include 'functions.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    loginAndRedirect($username, $password);

?>
