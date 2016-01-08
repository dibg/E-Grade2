<?php
    include 'functions.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
    echo "you are in the admin page";
