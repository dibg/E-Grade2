<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
?>
<script src="universityAjax.js"></script>

<div class="formContainer">
    <div id="msg"></div>
    <div class="university" id="add">
        <h4>Add University</h4>
        <form action="manageUniversitiesSubmit.php" method="post">
            <input type="text" name="universityName" placeholder="University Name"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="university" id="rename">
        <h4>Rename University</h4>
        <form action="manageUniversitiesSubmit.php" method="post">
            <?php
            $uni = getAllUniversitiesNames();
            echo generateDropDownList($uni, 'selectedUniversity');
            ?>
            <input type="text" name="universityName" placeholder="University Name"><br>
            <input type="submit" name="submit" value="rename">
        </form>
    </div>

    <div class="university" id="remove">
        <h4>Remove University</h4>
        <form action="manageUniversitiesSubmit.php" method="post">
            <?php
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
            <input type="submit" name="submit" class="warningButton" value="remove">
        </form>
    </div>
    </div>

<?php
    include 'footer.php';
?>