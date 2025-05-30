<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:entrepreneur_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>entrepreneur Dashboard</title>
    <?php
    include 'admin_css.php'
    ?>
</head>

<body>

   

    <?php
    include 'entrepreneur_sidebar.php'
    ?>

</body>

</html>