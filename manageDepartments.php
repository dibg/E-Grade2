<?php
include 'header.php';
?>

    <h4>Add Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        ?>
        <input type="text" name="departmentName" placeholder="Department Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <h4>Rename Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        //todo change me
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        ?>
        <input type="text" name="departmentName" placeholder="Department Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <h4>Delete Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        ?>
        <input type="submit" name="submit" id="warning" value="remove">
    </form>

    <h4>Transfer Department: </h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        ?>
        <input type="text" name="departmentName" placeholder="Department Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

<?php
include 'footer.php';
?>