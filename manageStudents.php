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
            <input type="text" name="studentUsername" placeholder="Student Username"><br>
            <input type="text" name="studentPassword" placeholder="Student Password"><br>
            <input type="submit" name="submit" value="change">
        </form>
    </div>

    <div class="student" id="transfer">
        <?php
        if(isLoginAsAdmin()) {
            ?>
            <h4>Transfer Student University And Department:</h4>
            <form action="" method="post">
                <?php
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityTransfer');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentTransfer');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentTransfer');
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversityTo', 'selectedUniversityTransferTo');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentIdTo', 'selectedDepartmentTransferTo');
                ?>
                <input type="submit" name="submit" value="transfer">
            </form>
            <?php
        }
        ?>
    </div>

    <div class="student" id="remove">
        <h4>Remove Student:</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityRemove');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentRemove');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getStudents($departmentId), 'selectedStudentId', 'selectedStudentRemove', 'studentId', 'studentUsername');
            }
            ?>
            <input type="submit" name="submit" class="warningButton" value="remove">
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
            if (isSetAndIsNotNull($_POST['selectedStudentId'])) {
                $studentId = $_POST['selectedStudentId'];
                if(isSetAndIsNotNull($_POST['studentUsername'])){
                    $studentUsername = $_POST['studentUsername'];
                    changestudentUsername($studentUsername, $studentId);
                }

                if(isSetAndIsNotNull($_POST['studentPassword'])){
                    $studentPassword = $_POST['studentPassword'];
                    changestudentPassword($studentPassword, $studentId);
                }
            }
        } else if ($submit == 'transfer') {
            if (isSetAndIsNotNull($_POST['selectedStudentId']) && isSetAndIsNotNull($_POST['selectedDepartmentIdTo'])) {
                $studentId = $_POST['selectedStudentId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                transferStudent($studentId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedStudentId'])) {
                $studentId = $_POST['selectedStudentId'];

                removeStudent($studentId);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>