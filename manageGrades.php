<?php
include 'header.php';
include 'gradesAjax.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY", "PROFESSOR"));
?>

<div class="formContainer">
    <div class="grade" id="add">
        <h4>Add Grade</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentAdd');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
            }
            ?>
            <input type="text" name="gradeValue" placeholder="Grade Value"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="grade" id="change">
        <h4>Change Grade</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityChange');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedGradeId', 'selectedGradeChange');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getGrades($departmentId), 'selectedGradeId', 'selectedGradeChange', 'gradeId', 'gradeValue');
            }
            ?>
            <input type="text" name="gradeValue" placeholder="Grade Value"><br>
            <input type="submit" name="submit" value="change">
        </form>
    </div>

    <div class="grade" id="remove">
        <h4>Remove Grade</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityRemove');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedGradeId', 'selectedGradeRemove');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getGrades($departmentId), 'selectedGradeId', 'selectedGradeRemove', 'gradeId', 'gradeValue');
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
            if (isSetAndIsNotNull($_POST['gradeValue'])&& isSetAndIsNotNull($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $gradeValue = $_POST['gradeValue'];

                addGrade($gradeValue, $departmentId);
            }
        } else if ($submit == 'change') {
            if (isSetAndIsNotNull($_POST['selectedGradeId'])) {
                $gradeId = $_POST['selectedGradeId'];
                if(isSetAndIsNotNull($_POST['gradeValue'])){
                    $gradeValue = $_POST['gradeValue'];
                    changeGrade($gradeValue, $gradeId);
                }
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedGradeId'])) {
                $gradeId = $_POST['selectedGradeId'];

                removeGrade($gradeId);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>

