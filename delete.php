<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'us') {
    header("location:admin_login.php");
}
$host = "127.0.0.1:3306";

$user = "root";

$password = "";

$db = "ent";


$data = mysqli_connect($host, $user, $password, $db);
if ($_GET['entrepreneur_id']) {
    $user_id = $_GET['entrepreneur_id'];
    $sql = "delete from entrepreneur_apply where id='$user_id'";
    $result = mysqli_query($data, $sql);
    if ($result) {
        $_SESSION['message'] = 'Delete entrepreneur is successful';
        header("location: admission.php");
    }
}
if ($_GET['entmain_id']) {
    $user_id = $_GET['entmain_id'];
    $sql = "delete from entrepreneur_main where id='$user_id'";
    $result = mysqli_query($data, $sql);
    if ($result) {
        $_SESSION['message'] = 'Delete entrepreneur is successful';
        header("location: view_ent.php");
    }
}
