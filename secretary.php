<?php
    include 'functions.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "SECRETARY");

    echo "you are in the secretary page";