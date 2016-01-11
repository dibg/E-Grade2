<?php
    include 'header.php';
    include 'studentAjax.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>
    <div class="student" id="add">
        <h4>Add Student:</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
            }
            ?>
            <input type="text" name="StudentUsername" placeholder="Student Username"><br>
            <input type="text" name="StudentPassword" placeholder="Student Password"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="student" id="change">
        <h4>Change Student Name And Password:</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityChange');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentChange');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getStudents($departmentId), 'selectedStudentId', 'selectedStudentChange', 'studentId', 'studentUsername');
            }
            ?>
            <input type="text" name="professorUsername" placeholder="Professor Username"><br>
            <input type="text" name="professorPassword" placeholder="Professor Password"><br>
            <input type="submit" name="submit" value="change">
        </form>
    </div>

<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['StudentUsername']) && isSetAndIsNotNull($_POST['StudentPassword']) && isSetAndIsNotNull($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $studentUsername = $_POST['StudentUsername'];
                $studentPassword = $_POST['StudentPassword'];

                addStudent($studentUsername, $studentPassword, $departmentId);
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