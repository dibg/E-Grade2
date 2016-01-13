<?php
include 'header.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY", "PROFESSOR"));
?>
<script src="gradesAjax.js"></script>

<div class="formContainer">
    <div class="grade" id="add">
        <h4>Add Grade</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentAdd');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseAdd');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' id='selectedDepartmentAdd' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithFirstOptionAndSpecifiedValueKey(getStudents($departmentId), "Select Student", 'selectedStudentId', 'selectedStudentAddSec', 'studentId', 'studentUsername');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseAddSec');
            } else if(isLoginAsProfessor()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' id='selectedDepartmentAdd' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithFirstOptionAndSpecifiedValueKey(getStudents($departmentId), "Select Student", 'selectedStudentId', 'selectedStudentAddSec', 'studentId', 'studentUsername');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseAddSec');
            }
            ?>
            <input type="text" name="gradeValue" placeholder="Grade Value"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <?php if(!isLoginAsProfessor()) { ?>

    <div class="grade" id="change">
        <h4>Change Grade</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityChange');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentChange');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseChange');
                echo generateDropDownListWithFirstOption(null, "Select Course First", 'selectedGradeId', 'selectedGradeChange');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' id='selectedDepartmentChange' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithFirstOptionAndSpecifiedValueKey(getStudents($departmentId), "Select Student", 'selectedStudentId', 'selectedStudentChangeSec', 'studentId', 'studentUsername');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseChangeSec');
                echo generateDropDownListWithFirstOption(null, "Select Course First", 'selectedGradeId', 'selectedGradeChangeSec');
            }
            ?>
            <input type="text" name="gradeValue" placeholder="New Grade Value"><br>
            <input type="submit" name="submit" value="change">
        </form>
    </div>

    <div class="grade" id="remove">
        <h4>Remove Grade</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityRemove');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedStudentId', 'selectedStudentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseRemove');
                echo generateDropDownListWithFirstOption(null, "Select Course First", 'selectedGradeId', 'selectedGradeRemove');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' id='selectedDepartmentRemove' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithFirstOptionAndSpecifiedValueKey(getStudents($departmentId), "Select Student", 'selectedStudentId', 'selectedStudentRemoveSec', 'studentId', 'studentUsername');
                echo generateDropDownListWithFirstOption(null, "Select Student First", 'selectedCourseId', 'selectedCourseRemoveSec');
                echo generateDropDownListWithFirstOption(null, "Select Course First", 'selectedGradeId', 'selectedGradeRemoveSec');
            }
            ?>
            <input type="submit" name="submit" class="warningButton" value="remove">
        </form>
    </div>

    <?php } ?>

</div>

<?php
if(isSetAndIsNotNull($_POST)){
    if (isSetAndIsNotNull($_POST['submit'])) {
        $submit = $_POST['submit'];
        if ($submit == 'add') {
            if (isSetAndIsNotNull($_POST['selectedStudentId']) && isSetAndIsNotNull($_POST['gradeValue']) && isSetAndIsNotNull($_POST['selectedCourseId'])) {
                $studentId = $_POST['selectedStudentId'];
                $gradeValue = $_POST['gradeValue'];
                $courseId = $_POST['selectedCourseId'];

                addGrade($gradeValue, $studentId, $courseId);
            }
        } else if ($submit == 'change') {
            if (isSetAndIsNotNull($_POST['selectedGradeId']) && isSetAndIsNotNull($_POST['gradeValue'])) {
                $gradeId = $_POST['selectedGradeId'];
                $gradeValue = $_POST['gradeValue'];


                changeGrade($gradeValue, $gradeId);
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

