<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
} else if ($_SESSION['usertype'] == 'admin') {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <?php
    include 'admin_css.php'
    ?>
</head>

<body>

    <h1>User Dashboard</h1>

    <?php
    include 'user_sidebar.php'
    ?>

</body>

</html>