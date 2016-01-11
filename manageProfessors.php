<?php
include 'header.php';
checkAndRedirectNotAuthorizedUsers($_SESSION, array("ADMIN", "SECRETARY"));
?>

    <h4>Add Professor:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment');
        ?>
        <input type="text" name="professorUsername" placeholder="Professor Username"><br>
        <input type="text" name="professorPassword" placeholder="Professor Password"><br>
        <input type="submit" name="submit" value="add">
    </form>


    <h4>Change Professor Name And Password:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment');
        $pro = getProfessorsUsernames('cMIT', 'Informatics'); //todo
        echo generateDropDownList($pro, 'selectedProfessor');
    ?>
        <input type="text" name="professorUsername" placeholder="Professor Username"><br>
        <input type="text" name="professorPassword" placeholder="Professor Password"><br>
        <input type="submit" name="submit" value="change">
    </form>

    <h4>Transfer Professor University And Department:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity', 'group1');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment', 'group1');
        $pro = getProfessorsUsernames('cMIT', 'Informatics'); //todo
        echo generateDropDownList($pro, 'selectedProfessor', 'group1');
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity', 'group2');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment', 'group2');
    ?>
        <input type="submit" name="submit" value="transfer">
    </form>

    <h4>Remove Professor:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversitiesNames();
        echo generateDropDownList($uni, 'selectedUniversity');
        $dep = getDepartmentsNames('cMIT'); //todo
        echo generateDropDownList($dep, 'selectedDepartment');
        $pro = getProfessorsUsernames('cMIT', 'Informatics'); //todo
        echo generateDropDownList($pro, 'selectedProfessor');
        ?>
        <input type="submit" name="submit" class="warningButton" value="remove">
    </form>

<?php
include 'footer.php';
?>