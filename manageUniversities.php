<?php
    include 'header.php';
//echo getTableWithAllUniversities();
//echo getTableWithAllDepartments("cmit");
?>

    <h4>Add University:</h4>
    <form action="" method="post">
        <input type="text" name="universityName" placeholder="University Name"><br>
        <input type="submit" name="add" value="add">
    </form>

    <h4>Remove University:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="submit" name="remove" id="warning" value="remove">
    </form>

    <h4>Rename University:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="text" name="universityName" placeholder="University Name"><br>
        <input type="submit" name="rename" value="rename">
    </form>

<?php
if (isset($_POST) && $_POST != null) {
    if (isset($_POST['universityName']) && $_POST['universityName'] != null) {
        if (isset($_POST['add'])) {
            addUniversity($_POST['universityName']);
        } elseif (isset($_POST['rename'])) {
            if (isset($_POST['selectedUniversity']) && $_POST['selectedUniversity'] != null) {
                renameUniversity($_POST['selectedUniversity'], $_POST['universityName']);
            }
        }
    } else if (isset($_POST['remove'])) {
        if (isset($_POST['selectedUniversity']) && $_POST['selectedUniversity'] != null) {
            removeUniversity($_POST['selectedUniversity']);
        }
    }
}
    include 'footer.php';
?>