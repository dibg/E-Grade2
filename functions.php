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
            redirectTo("student.php");
        }

        if(isset($rowProfessor['professorUsername']) && isset($rowProfessor['professorPassword'])){
            session_start();
            $_SESSION["user"] = $rowProfessor['professorUsername'];
            $_SESSION["role"] = "PROFESSOR";
            redirectTo("professor.php");
        }

        if(isset($rowSecretary['secretaryUsername']) && isset($rowSecretary["secretaryPassword"])){
            session_start();
            $_SESSION["user"] = $rowSecretary['secretaryUsername'];
            $_SESSION["role"] = "SECRETARY";
            redirectTo("secretary.php");
        }

        if(isset($rowAdmin['adminUsername']) && isset($rowAdmin['adminPassword'])){
            session_start();
            $_SESSION["user"] = $rowAdmin['adminUsername'];
            $_SESSION["role"] = "ADMIN";
            redirectTo("administrator.php");
        }
    }
}

function checkAndRedirectNotAuthorizedUsers($session, $expectedRole) {
    if(isset($session)) {
        $role = $session['role'];
        if($role != $expectedRole) {
            redirectTo("accessDenied.php");
        }
    } else {
        redirectTo("accessDenied.php");
    }
}

function clearSession() {
    session_unset();
}

function redirectTo($page) {
    header("Location: " . $page);
    exit();
}

function fadeOut($element, $milliseconds) {
    echo "<script src='jquery.min.js'></script>";
    printf('
    <script>
        $(document).ready(function(){
            $(\'%s\').fadeOut(%d
             );
        });
    </script>
    ', $element, $milliseconds);
}

function loginCredentialsError () {
    if(isset($_GET['login'])){
        if($_GET['login'] == 'failed'){
            fadeOut("h3", 3000);
            echo "<h3 id='error'>The credentials is incorrect please try again.</h3>";
        } else if ($_GET['login'] == 'admin') {
            fadeOut("h3", 3000);
            echo "<h3 id='error'>Very Funny.</h3>";
        }
    }
}

function getStudentGrades($username) {
    $query = mysql_query("CALL getStudentGrades('$username')");

    $result = null;
    $i = 0;
    while($row = mysql_fetch_array($query)) {
        $result[$i]['course'] = $row['courseName'];
        $result[$i]['grade'] = $row['grade'];
        $i++;
    }
    return $result;
}

function tableWithStudentGrades($username) {
    $grades = getStudentGrades($username);
    $output = "<table><th>Course</th><th>Grade</th>";
    if(isset($grades) && $grades != null){
        foreach($grades as $i => $obj) {
            $course = $obj['course'];
            $grade = $obj['grade'];

            $output .= "<tr><td>$course</td><td>$grade</td></tr>";
        }
    }

    $output .="</table>";

    return $output;
}