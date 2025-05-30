<?php
error_reporting(0);
session_start();

$host = "127.0.0.1:3306";
$user = "root";
$password = "";
$db = "ent";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
	die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['ent_name'];
	$pass = $_POST['password'];

	// Use prepared statement to prevent SQL injection
	$stmt = $data->prepare("SELECT * FROM entrepreneur_main WHERE full_name = ? AND password = ?");

	$stmt->bind_param("ss", $name, $pass);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($row = $result->fetch_assoc()) {
		// Login successful
		$_SESSION['name'] = $name;

		header("Location: entrepreneurhome.php");
		exit();
	} else {
		// Login failed
		$message = "Username or password do not match";
		$_SESSION['loginMessage'] = $message;
		header("Location: entrepreneur_login.php");
		exit();
	}

	$stmt->close();
}
