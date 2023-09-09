<?php
include_once '../database.php';

$sql = new Database();

if (isset($_GET['id'])) {
    $sql->delete("student_info", "sid = {$_GET['id']}");

    header("Location:../index.php");
}
