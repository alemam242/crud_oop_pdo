<?php
include 'header.php';
include_once 'database.php';

$sql = new Database();

if (isset($_GET['id'])) {
    $sql->selectAll("student_info", "class_info", "student_info.sclass = class_info.cid AND student_info.sid = {$_GET['id']}");
    $result = $sql->getResponse();

    $sql->selectAll("class_info");
    // echo '<pre>';
    // print_r($sql->getResponse());
    // echo '</pre>';

    $classes = $sql->getResponse();
    // print_r($result);

    // echo $result[0]["sname"];
}

// $sql->update("student_info", ["sname" => "Emam", "address" => "Purobi"], "sid = 2");


?>

<div id="main-content">
    <h2>Update Record</h2>
    <form class="post-form" action="backend/updateData.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="hidden" name="sid" value="<?= $result[0]["sid"] ?>" />
            <input type="text" name="sname" value="<?= $result[0]["sname"] ?>" required />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?= $result[0]["saddress"] ?>" required />
        </div>
        <div class="form-group">
            <label>Class</label>
            <select name="sclass" required>
                <?php
                foreach ($classes as $row) {
                    if ($row['cid'] == $result[0]["sclass"]) {
                        echo "<option value='{$row['cid']}' selected>{$row['cname']}</option>";
                    } else {
                        echo "<option value='{$row['cid']}'>{$row['cname']}</option>";
                    }
                }
                ?>

            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?= $result[0]["sphone"] ?>" required />
        </div>
        <input class="submit" type="submit" name="submit" />
    </form>
</div>
</div>
</body>

</html>