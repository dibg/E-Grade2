<?php
    include 'functions.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "STUDENT");
    echo "you are in the student page";