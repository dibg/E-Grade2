<?php
    include 'header.php';
    checkAndRedirectNotAuthorizedUsers($_SESSION, "ADMIN");
?>
<script src="departmentAjax.js"></script>
<script src="formSubmitAjax.js"></script>

<div class="formContainer">
    <div class="department" id="add">
        <h4>Add Department </h4>
        <form action="manageDepartmentsSubmit.php" method="post">
            <?php
            $uni = getAllUniversitiesNames();
            echo generateDropDownList($uni, 'selectedUniversity');
            ?>
            <input type="text" name="departmentName" placeholder="Department Name"><br>
            <input type="text" name="secretaryUsername" placeholder="Secretary Username"><br>
            <input type="text" name="secretaryPassword" placeholder="Secretary Password"><br>
            <input type="submit" name="submit" value="add">
        </form>
    </div>

    <div class="department" id="rename">
        <h4>Rename Department </h4>
        <form action="manageDepartmentsSubmit.php" method="post">
            <?php
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityRename');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartment', 'selectedDepartmentRename');
            ?>
            <input type="text" name="departmentName" placeholder="Department Name"><br>
            <input type="submit" name="submit" value="rename">
        </form>
    </div>

    <div class="department" id="change">
        <h4>Change Secretary Username And Password </h4>
        <form action="manageDepartmentsSubmit.php" method="post">
            <?php
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityChange');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentChange');
            echo generateDropDownListWithFirstOption(null, "Select Department First", 'selectedSecretaryId', 'selectedSecretaryChange');
            ?>
            <input type="text" name="secretaryUsername" placeholder="Secretary Username"><br>
            <input type="text" name="SecretaryPassword" placeholder="Secretary Password"><br>
            <input type="submit" name="submit" value="change">
        </form>
    </div>

    <div class="department" id="transfer">
        <h4>Transfer Department </h4>
        <form action="manageDepartmentsSubmit.php" method="post">
            <?php
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityTransfer');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentTransferId');
            echo generateDropDownListWithSpecifiedValueKey(getAllUniversities(), 'transferToSelectedUniversityId', 'transferToSelectedUniversityId', 'universityId', 'universityName')
            ?>
            <input type="submit" name="submit" value="transfer">
        </form>
    </div>

    <div class="department" id="remove">
        <h4>Remove Department </h4>
        <form action="manageDepartmentsSubmit.php" method="post">
            <?php
            echo generateDropDownListWithFirstOption(getAllUniversitiesNames(), "Select University", 'selectedUniversity', 'selectedUniversityDelete');
            echo generateDropDownListWithFirstOption(null, "Select University First", 'selectedDepartmentId', 'selectedDepartmentDelete');
        ?>
            <input type="submit" name="submit" class="warningButton" value="remove">
        </form>
    </div>
</div>

<?php
include 'footer.php';
?>