<?php include 'functions.php'; ?>
<link rel="stylesheet" href="stylesheet.css?1.1">

<form action="loginSubmit.php" method="post">
    <h1>E-Grade Log-in</h1><br>
    <?php loginCredentialsError();?>
    Username:<input type="text" name="username" id="username"  placeholder="Username"><br>
    Password:<input type="password" name="password" id="password" placeholder="Password"><br>
    <input type="submit"  name="login" class="login login-submit" value="Sign In">
</form>

<?php
    clearSession();
?>
