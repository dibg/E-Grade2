<?php
    include 'header.php';
?>

<div id="loginForm">
    <form action="loginSubmit.php" method="post">
        <h1>E-Grade Log-in</h1><br>
        <?php
            loginMessageHandler();
            redirectLoginUser();
        ?>
        <input type="text" name="username" id="username"  placeholder="Username"><br>
        <input type="password" name="password" id="password" placeholder="Password"><br>
        <input type="submit"  name="login" class="login login-submit" value="Sign In">
    </form>
</div>

<?php
    include 'loginHelper.php';
    include 'footer.php';
?>
