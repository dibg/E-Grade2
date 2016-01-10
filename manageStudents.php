<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>

    <h4>Add Student:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="text" name="StudentUsername" placeholder="Student Username"><br>
        <input type="text" name="StudentPassword" placeholder="Student Password"><br>
        <input type="submit" name="submit" value="add">
    </form>

<?php
include 'footer.php';
?>