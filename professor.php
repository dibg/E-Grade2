<?php
    include 'functions.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "PROFESSOR");

    echo "you are in the professor page";