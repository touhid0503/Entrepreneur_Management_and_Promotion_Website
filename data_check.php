<?php
session_start();
$host = "127.0.0.1:3306";
$user = "root";
$password = "";
$db = "ent";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_POST['apply'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $usertype = "us";

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = "Username already exists. Please choose another.";
        header("Location: index.html");
        exit();
    } else {
        // Insert without password hashing
        $stmt = $conn->prepare("INSERT INTO user (username, phone, email, usertype, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $phone, $email, $usertype, $password);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful!";
        } else {
            $_SESSION['message'] = "Registration failed. Please try again.";
        }

        header("Location: index.html");
        exit();
    }
}
?>
