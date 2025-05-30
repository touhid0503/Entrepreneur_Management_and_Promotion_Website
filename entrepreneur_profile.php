<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: entrepreneur_login.php");
    exit();
}

$host = "127.0.0.1:3306";
$user = "root";
$password = "";
$db = "ent";

$conn = mysqli_connect($host, $user, $password, $db);
$name = $_SESSION['name'];

$sql = "SELECT * FROM entrepreneur_main WHERE full_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Entrepreneur Profile</title>
    <?php include 'admin_css.php'; ?>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            font-size: 18px;
        }

        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-header img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 4px solid #007BFF;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-header h2 {
            font-size: 28px;
            margin: 10px 0 5px;
        }

        .profile-header .subtitle {
            color: #666;
            font-size: 16px;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .grid-item {
            background: #f9fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #007BFF;
        }

        .grid-item.full {
            grid-column: span 2;
        }

        .grid-item p,
        .grid-item ul {
            margin: 10px 0 0;
            font-size: 16px;
        }

        .grid-item ul {
            padding-left: 20px;
        }

        .grid-item ul li {
            margin-bottom: 5px;
        }

        .product-img {
            width: 220px;
            height: auto;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .grid-item.full {
                grid-column: span 1;
            }

            .profile-container {
                padding: 20px;
            }

            .profile-header h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    
    <?php include 'entrepreneur_sidebar.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <img src="<?php echo $info['profile_pic'] ?: 'default_profile.png'; ?>" alt="Profile Picture">
            <h2><?php echo $info['full_name']; ?></h2>
            <p class="subtitle"><?php echo $info['business_name']; ?> | <?php echo $info['business_type']; ?></p>
        </div>

        <div class="profile-grid">
            <div class="grid-item"><strong>Date of Birth:</strong><br><?php echo $info['dob']; ?></div>
            <div class="grid-item"><strong>NID/Passport:</strong><br><?php echo $info['nid_passport']; ?></div>
            <div class="grid-item"><strong>Phone:</strong><br><?php echo $info['phone']; ?></div>
            <div class="grid-item"><strong>Email:</strong><br><?php echo $info['email']; ?></div>
            <div class="grid-item"><strong>Present Address:</strong><br><?php echo $info['present_address']; ?></div>
            <div class="grid-item"><strong>Permanent Address:</strong><br><?php echo $info['permanent_address']; ?></div>
            <div class="grid-item"><strong>Business Location:</strong><br><?php echo $info['business_location']; ?></div>
            <div class="grid-item"><strong>Start Year:</strong><br><?php echo $info['start_year']; ?></div>
            <div class="grid-item"><strong>Registration No:</strong><br><?php echo $info['registration_no']; ?></div>
            <div class="grid-item"><strong>Turnover:</strong><br><?php echo $info['turnover']; ?></div>
            <div class="grid-item"><strong>Team Size:</strong><br><?php echo $info['team_size']; ?></div>
            <div class="grid-item"><strong>Reference:</strong><br><?php echo $info['reference']; ?></div>

            <div class="grid-item full">
                <strong>Motivation:</strong><br>
                <p><?php echo nl2br($info['motivation']); ?></p>
            </div>

            <div class="grid-item full">
                <strong>Documents:</strong>
                <ul>
                    <li><a href="<?php echo $info['nid_file']; ?>" target="_blank">NID File</a></li>
                    <li><a href="<?php echo $info['trade_license']; ?>" target="_blank">Trade License</a></li>
                    <li><a href="<?php echo $info['tin_cert']; ?>" target="_blank">TIN Certificate</a></li>
                </ul>
            </div>

            <div class="grid-item full">
                <strong>Product Image:</strong><br>
                <img class="product-img" src="<?php echo $info['product_image']; ?>" alt="Product Image">
            </div>

            <div class="grid-item full">
                <strong>Social Media:</strong><br>
                <p>
                    <a href="<?php echo $info['facebook']; ?>" target="_blank">Facebook</a> |
                    <a href="<?php echo $info['instagram']; ?>" target="_blank">Instagram</a> |
                    <a href="<?php echo $info['website']; ?>" target="_blank">Website</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
