<?php
session_start();
include 'connection.php';

function loginAndRedirect($username, $password)
{
    if (isset($username) && isset($password)) {
        $queryStudent =     mysql_query("SELECT *  FROM student    WHERE studentUsername   = '$username' AND studentPassword    = ('$password')") or die(mysql_error());
        $queryProfessor =   mysql_query("SELECT *  FROM professor  WHERE professorUsername = '$username' AND professorPassword  = ('$password')") or die(mysql_error());
        $querySecretary =   mysql_query("SELECT *  FROM secretary  WHERE secretaryUsername = '$username' AND secretaryPassword  = ('$password')") or die(mysql_error());
        $queryAdmin =       mysql_query("SELECT *  FROM admin      WHERE adminUsername     = '$username' AND adminPassword      = ('$password')") or die(mysql_error());

        $rowStudent = mysql_fetch_array($queryStudent);
        $rowProfessor = mysql_fetch_array($queryProfessor);
        $rowSecretary = mysql_fetch_array($querySecretary);
        $rowAdmin = mysql_fetch_array($queryAdmin);

        if(isset($rowStudent['studentUsername']) && isset($rowStudent['studentPassword'])){
            session_start();
            $_SESSION["user"] = $rowStudent['studentUsername'];
            $_SESSION["role"] = "STUDENT";
            header("Location: student.php");
            exit();
        }

        if(isset($rowProfessor['professorUsername']) && isset($rowProfessor['professorPassword'])){
            session_start();
            $_SESSION["user"] = $rowProfessor['professorUsername'];
            $_SESSION["role"] = "PROFESSOR";
            header("Location: professor.php");
            exit();
        }

        if(isset($rowSecretary['secretaryUsername']) && isset($rowSecretary["secretaryPassword"])){
            session_start();
            $_SESSION["user"] = $rowSecretary['secretaryUsername'];
            $_SESSION["role"] = "SECRETARY";
            header("Location: secretary.php");
            exit();
        }

        if(isset($rowAdmin['adminUsername']) && isset($rowAdmin['adminPassword'])){
            session_start();
            $_SESSION["user"] = $rowAdmin['adminUsername'];
            $_SESSION["role"] = "ADMIN";
            header("Location: administrator.php");
            exit();
        }
    }
}

function checkAndRedirectNotAuthorizedUsers($session, $expectedRole) {
    if(isset($session)) {
        $role = $session['role'];
        if($role != $expectedRole) {
            header("Location: accessDenied.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}

function clearSession() {
    session_unset();
}