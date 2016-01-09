<?php
    include 'header.php';
//echo getTableWithAllUniversities();
//echo getTableWithAllDepartments("cmit");
?>

    <h4>Add University:</h4>
    <form action="" method="post">
        <input type="text" name="universityName" placeholder="University Name"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <h4>Remove University:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        ?>
        <input type="submit" name="submit" id="warning" value="remove">
    </form>

    <h4>Rename University:</h4>
    <form action="" method="post">
        <?php
        $uni = getAllUniversities();
        echo generateDropDownList($uni);
        ?>
        <input type="text" name="universityName" placeholder="University Name"><br>
        <input type="submit" name="submit" value="rename">
    </form>

<?php
    include 'footer.php';
?>