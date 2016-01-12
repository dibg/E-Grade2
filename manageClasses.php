<?php
include 'header.php';
include 'classesAjax.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>

<div class="dataForm">
    <div class="class" id="add">
        <h4>Add Class:</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityProAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentProAdd');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorProAdd');
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityCouAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentCouAdd');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedCourseId', 'selectedCourseCouAdd');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getProfessors($departmentId), 'selectedProfessorId', 'selectedProfessorAdd', 'professorId', 'professorUsername');
                echo generateDropDownListWithSpecifiedValueKey(getCourses($departmentId), 'selectedCourseId', 'selectedCourseAdd', 'courseId', 'courseName');
            }
            ?>
            <input type="text" name="className" placeholder="Class Name"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="class" id="rename">
        <h4>Rename Class:</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityChange');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedClassId', 'selectedClassChange');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getClasses($departmentId), 'selectedClassId', 'selectedClassChange', 'classId', 'className');
            }
            ?>
            <input type="text" name="className" placeholder="Class Name"><br>
            <input type="submit" name="submit" value="rename">
        </form>
    </div>


    <div class="class" id="remove">
        <h4>Remove Class:</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University First", 'selectedUniversity', 'selectedUniversityRemove');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedClassId', 'selectedClassRemove');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getClasses($departmentId), 'selectedClassId', 'selectedClassRemove', 'classId', 'className');
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
            if (isSetAndIsNotNull($_POST['className'])&& isSetAndIsNotNull($_POST['selectedDepartmentId']) &&
                isSetAndIsNotNull($_POST['selectedProfessorId']) && isSetAndIsNotNull($_POST['selectedCourseId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $className = $_POST['className'];
                $professorId = $_POST['selectedProfessorId'];
                $courseId = $_POST['selectedCourseId'];

                addClass($className, $departmentId, $professorId, $courseId);
            }
        } else if ($submit == 'rename') {
            if (isSetAndIsNotNull($_POST['selectedClassId'])) {
                $classId = $_POST['selectedClassId'];
                if(isSetAndIsNotNull($_POST['className'])){
                    $className = $_POST['className'];
                    renameClass($className, $classId);
                }
            }
        } else if ($submit == 'remove') {
            if (isSetAndIsNotNull($_POST['selectedClassId'])) {
                $classId = $_POST['selectedClassId'];

                removeClass($classId);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>