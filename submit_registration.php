<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ent");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST inputs
$full_name = $_POST['full_name'];
$dob = $_POST['dob'];
$nid_passport = $_POST['nid_passport'];
$present_address = $_POST['present_address'];
$permanent_address = $_POST['permanent_address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password']; // Optionally use password_hash($password, PASSWORD_DEFAULT);

$business_name = $_POST['business_name'];
$business_type = $_POST['business_type'];
$business_location = $_POST['business_location'];
$start_year = $_POST['start_year'];
$registration_no = $_POST['registration_no'];
$turnover = $_POST['turnover'];

$motivation = $_POST['motivation'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$website = $_POST['website'];
$team_size = $_POST['team_size'];
$reference = $_POST['reference'];

// File upload function
function uploadFile($fileInputName) {
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== 0) {
        return null;
    }

    $targetDir = "uploads/";

    // Create folder if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Safe and unique file name
    $originalName = basename($_FILES[$fileInputName]["name"]);
    $safeName = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalName);
    $targetPath = $targetDir . $safeName;

    if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetPath)) {
        return $targetPath;
    } else {
        error_log("Failed to upload: $fileInputName");
        return null;
    }
}

// Upload files
$nid_file       = uploadFile('nid_file');
$trade_license  = uploadFile('trade_license');
$tin_cert       = uploadFile('tin_cert');
$product_image  = uploadFile('product_image');
$profile_pic = uploadFile('profile_pic');


// Insert data into database
$sql = "INSERT INTO entrepreneur_apply (
    full_name, dob, nid_passport, present_address, permanent_address, phone, email, password,
    business_name, business_type, business_location, start_year, registration_no, turnover,
    nid_file, trade_license, tin_cert, product_image,profile_pic,
    motivation, facebook, instagram, website, team_size, reference
) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "sssssssssssssssssssssssis",
    $full_name,
    $dob,
    $nid_passport,
    $present_address,
    $permanent_address,
    $phone,
    $email,
    $password,
    $business_name,
    $business_type,
    $business_location,
    $start_year,
    $registration_no,
    $turnover,
    $nid_file,
    $trade_license,
    $tin_cert,
    $product_image,
    $profile_pic,
    $motivation,
    $facebook,
    $instagram,
    $website,
    $team_size,
    $reference
);



if ($stmt->execute()) {
    $_SESSION['message'] = "Registration submitted successfully!";
    header("Location: user.php");
    exit();
} else {
    echo "❌ Error inserting data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
