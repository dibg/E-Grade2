<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>
<script src="coursesAjax.js"></script>

<div class="formContainer">
    <div class="course" id="add">
        <h4>Add Course</h4>
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
        <input type="text" name="courseName" placeholder="Course Name"><br>
        <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="course" id="rename">
        <h4>Rename Course</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityChange');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedCourseId', 'selectedCourseChange');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getCourses($departmentId), 'selectedCourseId', 'selectedCourseChange', 'courseId', 'courseName');
            }
            ?>
            <input type="text" name="courseName" placeholder="Course Name"><br>
            <input type="submit" name="submit" value="rename">
        </form>
    </div>

    <div class="course" id="transfer">
        <?php
        if(isLoginAsAdmin()) {
            ?>
            <h4>Transfer Course University And Department</h4>
            <form action="" method="post">
                <?php
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityTransfer');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentTransfer');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedCourseId', 'selectedCourseTransfer');
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversityTo', 'selectedUniversityTransferTo');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentIdTo', 'selectedDepartmentTransferTo');
                ?>
                <input type="submit" name="submit" value="transfer">
            </form>
            <?php
        }
        ?>
    </div>

    <div class="course" id="remove">
        <h4>Remove Course</h4>
        <form action="" method="post">
            <?php
            if(isLoginAsAdmin()) {
                echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityRemove');
                echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentRemove');
                echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedCourseId', 'selectedCourseRemove');
            } else if(isLoginAsSecretary()) {
                $departmentId = $_SESSION["departmentId"];
                echo "<input type='hidden' name='selectedDepartmentId' value='$departmentId'>";
                echo generateDropDownListWithSpecifiedValueKey(getCourses($departmentId), 'selectedCourseId', 'selectedCourseRemove', 'courseId', 'courseName');
            }
            ?>
            <input type="submit" name="submit" class="warningButton" value="remove">
        </form>
    </div>

</div>

<?php
if(!empty($_POST)){
    if (!empty($_POST['submit'])) {
        $submit = $_POST['submit'];

        if ($submit == 'add') {
            if (!empty($_POST['courseName'])&& !empty($_POST['selectedDepartmentId'])) {
                $departmentId = $_POST['selectedDepartmentId'];
                $courseName = $_POST['courseName'];

                addCourse($courseName, $departmentId);
            }
        } else if ($submit == 'rename') {
            if (!empty($_POST['selectedCourseId'])) {
                $courseId = $_POST['selectedCourseId'];
                if(!empty($_POST['courseName'])){
                    $courseName = $_POST['courseName'];
                    renameCourse($courseName, $courseId);
                }
            }
        } else if ($submit == 'transfer') {
            if (!empty($_POST['selectedCourseId']) && !empty($_POST['selectedDepartmentIdTo'])) {
                $courseId = $_POST['selectedCourseId'];
                $departmentIdTo = $_POST['selectedDepartmentIdTo'];

                transferCourse($courseId, $departmentIdTo);
            }
        } else if ($submit == 'remove') {
            if (!empty($_POST['selectedCourseId'])) {
                $courseId = $_POST['selectedCourseId'];

                removeCourse($courseId);
            }
        }
    }
    reloadPage();
}
include 'footer.php';
?>