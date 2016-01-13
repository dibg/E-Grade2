<?php
include 'header.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>
<script src="professorAjax.js"></script>

<div class="formContainer">
    <div class="professor" id="add">
        <h4>Add Professor</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
            }
            ?>
            <input type="text" name="professorUsername" placeholder="Professor Username"><br>
            <input type="text" name="professorPassword" placeholder="Professor Password"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="professor" id="change">
        <h4>Change Professor UserName And Password</h4>
        <form action="" method="post">
            <?php
        if(isLoginAsAdmin()) {
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityChange');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
            echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorChange');
        } else if(isLoginAsSecretary()) {
            $departmentId = $_SESSION["departmentId"];
            echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
            echo generateDropDownListWithSpecifiedValueKey(getProfessors($departmentId), 'selectedProfessorId', 'selectedProfessorChange', 'professorId', 'professorUsername');
        }
        ?>
            <input type="text" name="professorUsername" placeholder="Professor Username"><br>
            <input type="text" name="professorPassword" placeholder="Professor Password"><br>
            <input type="submit" name="submit" value="change">
        </form>
    </div>

    <div class="professor" id="transfer">
        <?php
            if(isLoginAsAdmin()) {
        ?>
        <h4>Transfer Professor University And Department</h4>
        <form action="" method="post">
            <?php
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityTransfer');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentTransfer');
            echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorTransfer');
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversityTo', 'selectedUniversityTransferTo');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentIdTo', 'selectedDepartmentTransferTo');
        ?>
            <input type="submit" name="submit" value="transfer">
        </form>
        <?php
            }
        ?>
    </div>

    <div class="professor" id="remove">
        <h4>Remove Professor</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityRemove');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorRemove');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getProfessors($departmentId), 'selectedProfessorId', 'selectedProfessorChange', 'professorId', 'professorUsername');
            }
            ?>
            <input type="submit" name="submit" class="warningButton" value="remove">
        </form>
    </div>
    </div>

<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['professorPassword']) && isSetAndIsNotNull($_POST['professorUsername'])&& isSetAndIsNotNull($_POST['selectedDepartmentId'])) {
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