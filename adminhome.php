<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'entrepreneur') {
	header("location:admin_login.php");
}
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminDashboard</title>
</head>
<body>
    <h1>AdminHome</h1>
    <a href="logout.php">Logout</a>
</body>
</html>-->

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

		<h1>Admin Dashboard</h1>




	</div>

</body>

</html>