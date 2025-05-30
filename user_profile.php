<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
} else if ($_SESSION['usertype'] == 'admin') {
    header("location:login.php");
}
$host = "127.0.0.1:3306";

$user = "root";

$password = "";

$db = "ent";


$data = mysqli_connect($host, $user, $password, $db);
$name = $_SESSION['username'];

$sql = "select * from user where username='$name'";
$result = mysqli_query($data, $sql);
$info = $result->fetch_assoc();

if (isset($_POST['update_profile'])) {
    //  $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $query = "UPDATE user SET email='$email', phone='$phone', password='$password' WHERE username='$name'";
    $result2 = mysqli_query($data, $query);
    if ($result2) {
        header("location:user_profile.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User Dashboard</title>
    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>
    <?php
    include 'admin_css.php'
    ?>
</head>

<body>
    <h1>User Dashboard</h1>
    <?php
    include 'user_sidebar.php'
    ?>

    <div class="content">

        <center>
            <h1>Update Profile</h1><br>

            <div class="div_deg">

                <form action="#" method="POST">

                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo "{$info['email']}"; ?>" </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone" value="<?php echo "{$info['phone']}"; ?>" </div>
                        <div>
                            <label>Password</label>
                            <input type="text" name="password" value="<?php echo "{$info['password']}"; ?>" </div>
                            <div>
                                <input type="submit" class="btn btn-primary" name="update_profile" value="Update">
                            </div>
                </form>
            </div>

        </center>




    </div>

</body>

</html>