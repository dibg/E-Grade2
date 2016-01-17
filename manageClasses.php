<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>
<script src="classesAjax.js"></script>

<div class="formContainer">
    <div class="class" id="add">
        <h4>Add Class</h4>
        <form action="manageClassesSubmit.php" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityAdd');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentAdd');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedProfessorId', 'selectedProfessorAdd');
                echo generateDropDownListWithFirstOption(null, "Select Professor First", 'selectedCourseId', 'selectedCourseAdd');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getProfessors($departmentId), 'selectedProfessorId', 'selectedProfessorAddSec', 'professorId', 'professorUsername');
                echo generateDropDownListWithSpecifiedValueKey(getCourses($departmentId), 'selectedCourseId', 'selectedCourseAddSec', 'courseId', 'courseName');
            }
            ?>
            <input type="text" name="className" placeholder="Class Name"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="class" id="rename">
        <h4>Rename Class</h4>
        <form action="manageClassesSubmit.php" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityChange');
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
        <h4>Remove Class</h4>
        <form action="manageClassesSubmit.php" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityRemove');
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
include 'footer.php';
?>