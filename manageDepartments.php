<?php
include 'header.php';
include 'departmentAjax.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
?>

    <h4>Add Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="text" name="departmentName" placeholder="Department Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <h4>Rename Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownListWithFirstOption($uni, "Select University First", 'selectedUniversity', 'selectedUniversity');
        echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartment', 'selectedDepartment');
        ?>
        <input type="text" name="departmentName" placeholder="Department Name"><br>
        <input type="submit" name="submit" value="rename">
    </form>

    <h4>Transfer Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        $dep = getDepartments('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment');
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="submit" name="submit" value="transfer">
    </form>

    <h4>Remove Department: </h4>
    <form action="" method="post">
        <?php
    $uni = getAllUniversities();
    echo generateDropDownList($uni, 'selectedUniversity');
    $dep = getDepartments('cMIT'); //todo
    echo generateDropDownList($dep, 'selectedDepartment');
    ?>
        <input type="submit" name="submit" class="warningButton" value="remove">
    </form>


<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['departmentName']) && isSetAndIsNotNull($_POST['selectedUniversity'])) {
                $departmentName = $_POST['departmentName'];
                $selectedUniversity = $_POST['selectedUniversity'];
                addDepartment($selectedUniversity, $departmentName);
            }
        } elseif ($submit == 'rename') {
            if (isSetAndIsNotNull($_POST['selectedUniversity']) && isSetAndIsNotNull($_POST['selectedDepartment']) && isSetAndIsNotNull($_POST['departmentName']) ) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $selectedDepartment = $_POST['selectedDepartment'];
                $departmentName = $_POST['departmentName'];

                renameDepartment($selectedUniversity, $selectedDepartment, $departmentName);
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedUniversity']) && isSetAndIsNotNull($_POST['selectedDepartment'])) {
                $selectedUniversity = $_POST['selectedUniversity'];
                $selectedDepartment = $_POST['selectedDepartment'];
                removeDepartment($selectedUniversity, $selectedDepartment);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>