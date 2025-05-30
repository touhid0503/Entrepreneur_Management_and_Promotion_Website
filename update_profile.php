<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: entrepreneur_login.php");
    exit();
}

include 'admin_css.php';

$host = "127.0.0.1:3306";
$user = "root";
$password = "";
$db = "ent";
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_SESSION['name'] ?? '';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function uploadFile($field, $folder = 'uploads/')
    {
        if (!empty($_FILES[$field]['name'])) {
            // Ensure folder exists
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }
            // Use unique name to avoid conflicts
            $filename = $folder . time() . '_' . basename($_FILES[$field]['name']);
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $filename)) {
                return $filename;
            }
        }
        return null;
    }

    // Collect input fields
    $fields = [
        'phone',
        'email',
        'present_address',
        'permanent_address',
        'business_name',
        'business_type',
        'business_location',
        'start_year',
        'registration_no',
        'turnover',
        'team_size',
        'reference',
        'motivation',
        'facebook',
        'instagram',
        'website'
    ];

    foreach ($fields as $f) {
        $$f = $_POST[$f] ?? '';
    }

    // Convert numeric fields properly
    $turnover = intval($turnover);
    $team_size = intval($team_size);
    // start_year can be kept as string or converted if desired

    // Upload files (if any)
    $profile_pic = uploadFile('profile_pic');
    $trade_license = uploadFile('trade_license');
    $tin_cert = uploadFile('tin_cert');
    $product_image = uploadFile('product_image');

    $sql = "UPDATE entrepreneur_main SET
         phone=?, email=?, present_address=?, permanent_address=?,
        business_name=?, business_type=?, business_location=?, start_year=?, registration_no=?,
        turnover=?, team_size=?, reference=?, motivation=?, facebook=?, instagram=?, website=?,
        profile_pic=IFNULL(?, profile_pic),
        trade_license=IFNULL(?, trade_license),
        tin_cert=IFNULL(?, tin_cert),
        product_image=IFNULL(?, product_image)
        WHERE full_name=?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssssssisssssssssss",
        $phone,
        $email,
        $present_address,
        $permanent_address,
        $business_name,
        $business_type,
        $business_location,
        $start_year,
        $registration_no,
        $turnover,
        $team_size,
        $reference,
        $motivation,
        $facebook,
        $instagram,
        $website,
        $profile_pic,
        $trade_license,
        $tin_cert,
        $product_image,
        $name
    );

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating profile: " . htmlspecialchars($stmt->error) . "');</script>";
    }
    $stmt->close();
}

// Fetch existing data for form pre-fill
$sql = "SELECT * FROM entrepreneur_main WHERE full_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include 'entrepreneur_sidebar.php'; ?>
    <h2>Update Your Profile</h2>

    <form method="POST" enctype="multipart/form-data">
        <?php
        function input($label, $value, $type = 'text')
        {
            $name = strtolower(str_replace(' ', '_', $label));
            $value = htmlspecialchars($value ?? '');
            echo "<label>$label</label><input type='$type' name='$name' value='$value'>";
        }

        input("Phone", $info['phone']);
        input("Email", $info['email'], 'email');
        input("Present Address", $info['present_address']);
        input("Permanent Address", $info['permanent_address']);
        input("Business Name", $info['business_name']);
        input("Business Type", $info['business_type']);
        input("Business Location", $info['business_location']);
        input("Start Year", $info['start_year']);
        input("Registration No", $info['registration_no']);
        input("Turnover", $info['turnover']);
        input("Team Size", $info['team_size']);
        input("Reference", $info['reference']);
        ?>

        <label>Motivation</label>
        <textarea name="motivation"><?php echo htmlspecialchars($info['motivation']); ?></textarea>

        <?php
        input("Facebook", $info['facebook']);
        input("Instagram", $info['instagram']);
        input("Website", $info['website']);
        ?>

        <label>Profile Picture</label>
        <input type="file" name="profile_pic">

        <label>Trade License</label>
        <input type="file" name="trade_license">

        <label>TIN Certificate</label>
        <input type="file" name="tin_cert">

        <label>Product Image</label>
        <input type="file" name="product_image">

        <button type="submit">Update Profile</button>
    </form>
</body>

</html>
