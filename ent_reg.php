<?php
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
$sql = "select * from admission";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>

    <?php
    include 'admin_css.php'
    ?>


</head>

<body>

    <?php
    include 'admin_sidebar.php'
    ?>

    <div class="content">
        <center>
            <h1>Applied for Admission</h1>
            <br><br>
            <table border="1px">
                <tr>
                    <th style="padding: 20px; font-size: 15px;">Name</th>
                    <th style="padding: 20px; font-size: 15px;">Email</th>
                    <th style="padding: 20px; font-size: 15px;">Phone</th>
                    <th style="padding: 20px; font-size: 15px;">Message</th>
                    <th style="padding: 20px; font-size: 15px;">Password</th>
                    <th style="padding: 20px; font-size: 15px;">Add</th>
                    <th style="padding: 20px; font-size: 20px;">Delete</th>
                </tr>
                <?php
                while ($info = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['name']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['email']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['phone']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['message']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "{$info['password']}";
                            ?>
                        </td>
                        <td style="padding: 20px;">
                            <a href="add_entrepreneur.php"><input type="submit" class="btn btn-primary" name="add_entrepreneur" value="add_entrepreneur"></a>
                        </td>
                        <td style="padding: 20px;">
                            <?php
                            echo "<a class='btn btn-danger' onclick=\" javascript:return confirm('Are you sure to delete this?'); \" href='delete.php?admission_id={$info['id']}'>Delete</a>";
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>

        </center>
    </div>

</body>

</html>