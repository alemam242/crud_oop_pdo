<?php
include_once 'header.php';
include_once 'database.php';

$sql = new Database();

$sql->selectAll("student_info", "class_info", "student_info.sclass = class_info.cid");
// $sql->select(["student_info.sid,student_info.sname,class_info.cname"], "student_info", "class_info", "student_info.sclass = class_info.cid");

// echo '<pre>';
// print_r($sql->getResponse());
// echo '</pre>';

$result = $sql->getResponse();

?>
<div id="main-content">
    <?php
    if (sizeof($result) > 0) {
        echo "<h2>All Records</h2>";
        echo "<table cellpadding='7px'>
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Class</th>
            <th>Phone</th>
            <th>Action</th>
        </thead>
        <tbody>";

        foreach ($result as $row) {
            echo "<tr>
            <td>{$row['sid']}</td>
            <td>{$row['sname']}</td>
            <td>{$row['saddress']}</td>
            <td>{$row['cname']}</td>
            <td>{$row['sphone']}</td>
            <td>
                <a href='edit.php?id={$row['sid']}'>Edit</a>
                <a href='backend/deleteData.php?id={$row['sid']}'>Delete</a>
            </td>
        </tr>";
        }


        echo "</tbody>
        </table>";
    } else {
        echo "<h2>No Records Found</h2>";
    }
    ?>

</div>
</div>

</body>

</html>