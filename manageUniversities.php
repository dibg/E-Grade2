<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
//echo getTableWithAllUniversities();
//echo getTableWithAllDepartments("cmit");
?>

    <h4>Add University:</h4>
    <form action="" method="post">
        <input type="text" name="universityName" placeholder="University Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <h4>Rename University:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="text" name="universityName" placeholder="University Name"><br>
        <input type="submit" name="submit" value="rename">
    </form>

    <h4>Remove University:</h4>
    <form action="" method="post">
        <?php
    $uni = getAllUniversities();
    echo generateDropDownList($uni, 'selectedUniversity');
    ?>
        <input type="submit" name="submit" class="warningButton" value="remove">
    </form>


<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['universityName'])) {
                $universityName = $_POST['universityName'];
                addUniversity($universityName);
            }
        } elseif ($submit == 'rename') {
            if (isSetAndIsNotNull($_POST['selectedUniversity']) && isSetAndIsNotNull($_POST['universityName'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $universityName = $_POST['universityName'];
                renameUniversity($selectedUniversity, $universityName);
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedUniversity'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                removeUniversity($selectedUniversity);
            }
        }
    }
    reloadPage();
}
    include 'footer.php';
?>