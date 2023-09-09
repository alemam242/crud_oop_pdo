<?php
include_once '../database.php';

$sql = new Database();

if (isset($_POST['submit'])) {
    if ($_POST['sid'] != '' && $_POST['sname'] != '' && $_POST['saddress'] != '' && $_POST['sclass'] != '' && $_POST['sphone'] != '') {
        $sql->update("student_info", ["sname" => "{$_POST['sname']}", "saddress" => "{$_POST['saddress']}", "sclass" => "{$_POST['sclass']}", "sphone" => "{$_POST['sphone']}"], "sid = {$_POST['sid']}");
    }

    header("Location:../index.php");
}
