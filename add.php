<?php
include_once 'header.php';
include_once 'database.php';

$sql = new Database();


$sql->selectAll("class_info");
// echo '<pre>';
// print_r($sql->getResponse());
// echo '</pre>';

$classes = $sql->getResponse();
?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="backend/addData.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="sname" required />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" required />
        </div>
        <div class="form-group">
            <label>Class</label>
            <select name="class" required>
                <option value="" selected disabled>Select Class</option>
                <?php
                foreach ($classes as $row) {
                    echo "<option value='{$row['cid']}'>{$row['cname']}</option>";
                }
                ?>
                <!-- <option value="1">BCA</option>
                <option value="2">BSC</option>
                <option value="3">B.TECH</option> -->
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" required />
        </div>
        <input class="submit" type="submit" name="submit" />
    </form>
</div>
</div>
</body>

</html>