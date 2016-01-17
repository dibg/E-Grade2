<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>
<script src="studentAjax.js"></script>
<script src="formSubmitAjax.js"></script>

<div class="formContainer">
    <div class="student" id="add">
        <h4>Add Student</h4>
        <form action="manageStudentsSubmit.php" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityAdd');
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
        <h4>Change Student Name And Password</h4>
        <form action="manageStudentsSubmit.php" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityChange');
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
            <h4>Transfer Student University And Department</h4>
            <form action="manageStudentsSubmit.php" method="post">
                <?php
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityTransfer');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentTransfer');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentTransfer');
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversityTo', 'selectedUniversityTransferTo');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentIdTo', 'selectedDepartmentTransferTo');
                ?>
                <input type="submit" name="submit" value="transfer">
            </form>
            <?php
        }
        ?>
    </div>

    <div class="student" id="remove">
        <h4>Remove Student</h4>
        <form action="manageStudentsSubmit.php" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityRemove');
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
</div>

<?php
include 'footer.php';
?>