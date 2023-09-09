<?php
include_once '../database.php';

$sql = new Database();

if (isset($_POST['submit'])) {
    if ($_POST['sname'] != '' && $_POST['saddress'] != '' && $_POST['class'] != '' && $_POST['sphone'] != '') {
        $sql->insert("student_info", ["sname" => "{$_POST['sname']}", "saddress" => "{$_POST['saddress']}", "sclass" => "{$_POST['class']}", "sphone" => "{$_POST['sphone']}"]);
    }

    header("Location:../index.php");
}
