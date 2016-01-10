<?php
include 'header.php';
?>

    <h4>Add Professor:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="text" name="professorName" placeholder="Professor Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <h4>Remove Professor:</h4>
    <form action="" method="post">
        <?php
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="submit" name="submit" id="warning" value="remove">
    </form>

    <h4>Change Professor Name And Password:</h4>
    <form action="" method="post">
        <?php
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="text" name="professorUsername" placeholder="Professor Username"><br>
        <input type="text" name="professorPassword" placeholder="Professor Password"><br>
        <input type="submit" name="submit" value="change">
    </form>

    <h4>Change Professor University And Department:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni, 'selectedUniversity');
        ?>
        <input type="submit" name="submit" value="change">
    </form>


<?php
include 'footer.php';
?>