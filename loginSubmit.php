<?php
    include 'functions.php';

    //var_dump($_POST);
    //var_dump($_COOKIE);
    $username = $_POST['username'];
    $password = $_POST['password'];
    loginAndRedirect($username, $password);

    header("Location: login.php");

?>
