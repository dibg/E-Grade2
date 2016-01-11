<?php
include 'header.php';
include 'professorAjax.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>

    <h4>Add Professor:</h4>
    <form action="" method="post">
        <?php
        echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityAdd');
        echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
        ?>
        <input type="text" name="professorUsername" placeholder="Professor Username"><br>
        <input type="text" name="professorPassword" placeholder="Professor Password"><br>
        <input type="submit" name="submit" value="add">
    </form>


    <h4>Change Professor Name And Password:</h4>
    <form action="" method="post">
        <?php
        echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityChange');
        echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
        $pro = getProfessorsUsernames('cMIT', 'Informatics'); //todo
        echo generateDropDownList($pro, 'selectedProfessorChange');
    ?>
        <input type="text" name="professorUsername" placeholder="Professor Username"><br>
        <input type="text" name="professorPassword" placeholder="Professor Password"><br>
        <input type="submit" name="submit" value="change">
    </form>
<?php
    if($role == "ADMIN") {
?>
    <h4>Transfer Professor University And Department:</h4>
    <form action="" method="post">
        <?php
        echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityTransfer');
        echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentTransfer');
        $pro = getProfessorsUsernames('cMIT', 'Informatics'); //todo
        echo generateDropDownList($pro, 'selectedProfessor', 'group1');
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity', 'group2');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment', 'group2');
    ?>
        <input type="submit" name="submit" value="transfer">
    </form>
<?php
        }
?>

    <h4>Remove Professor:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment');
        $pro = getProfessorsUsernames('cMIT', 'Informatics'); //todo
        echo generateDropDownList($pro, 'selectedProfessor');
        ?>
        <input type="submit" name="submit" class="warningButton" value="remove">
    </form>

<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['professorPassword']) && isSetAndIsNotNull($_POST['professorUsername'])&& isSetAndIsNotNull($_POST['selectedDepartmentId']) && isSetAndIsNotNull($_POST['selectedUniversity'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $professorUsername = $_POST['professorUsername'];
                $professorPassword = $_POST['professorPassword'];

                addProfessor($professorUsername, $professorPassword, $departmentId);
            }
        } else if ($submit == 'change') {
            if (isSetAndIsNotNull($_POST['professorPassword']) && isSetAndIsNotNull($_POST['professorUsername']) && isSetAndIsNotNull($_POST['selectedDepartmentId']) && isSetAndIsNotNull($_POST['selectedUniversity'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $professorUsername = $_POST['professorUsername'];
                $professorPassword = $_POST['professorPassword'];

                changeProfessor($professorUsername, $professorPassword, $professorId);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>