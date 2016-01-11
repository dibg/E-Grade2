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
        echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorChange');
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
        echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorTransfer');
        echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversityTo', 'selectedUniversityTransferTo');
        echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentIdTo', 'selectedDepartmentTransferTo');
    ?>
        <input type="submit" name="submit" value="transfer">
    </form>
<?php
        }
?>

    <h4>Remove Professor:</h4>
    <form action="" method="post">
        <?php
        echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityRemove');
        echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
        echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorRemove');
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
            if (isSetAndIsNotNull($_POST['selectedProfessorId'])) {
                $professorId = $_POST['selectedProfessorId'];
                if(isSetAndIsNotNull($_POST['professorUsername'])){
                    $professorUsername = $_POST['professorUsername'];
                    changeProfessorUsername($professorUsername, $professorId);

                }

                if(isSetAndIsNotNull($_POST['professorPassword'])){
                    $professorPassword = $_POST['professorPassword'];
                    changeProfessorPassword($professorPassword, $professorId);
                }
            }
        } else if ($submit == 'transfer') {
            if (isSetAndIsNotNull($_POST['selectedProfessorId']) && isSetAndIsNotNull($_POST['selectedDepartmentIdTo'])) {
                $professorId = $_POST['selectedProfessorId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                transferProfessor($professorId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedProfessorId'])) {
                $professorId = $_POST['selectedProfessorId'];

                removeProfessor($professorId);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>