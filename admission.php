<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'us') {
    header("location:admin_login.php");
}

$host = "127.0.0.1:3306";
$user = "root";
$password = "";
$db = "ent";

$data = mysqli_connect($host, $user, $password, $db);

// Fetch all entrepreneur applications
$sql = "SELECT * FROM entrepreneur_apply";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Entrepreneur Applications - Admin</title>
    <?php include 'admin_css.php'; ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <center>
            <h1>All Entrepreneur Applications</h1><br>

            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>DOB</th>
                        <th>NID/Passport</th>
                        <th>Present Address</th>
                        <th>Permanent Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Business Name</th>
                        <th>Business Type</th>
                        <th>Business Location</th>
                        <th>Start Year</th>
                        <th>Reg. No</th>
                        <th>Turnover</th>
                        <th>NID File</th>
                        <th>Trade License</th>
                        <th>TIN Certificate</th>
                        <th>Product Image</th>
                        <th>Profile Pic</th>
                        <th>Motivation</th>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Website</th>
                        <th>Team Size</th>
                        <th>Reference</th>
                        <th>Add</th>
                        <th>Delete</th>
                    </tr>
                    <?php while ($info = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $info['id'] ?></td>
                            <td><?= htmlspecialchars($info['full_name']) ?></td>
                            <td><?= $info['dob'] ?></td>
                            <td><?= $info['nid_passport'] ?></td>
                            <td><?= $info['present_address'] ?></td>
                            <td><?= $info['permanent_address'] ?></td>
                            <td><?= $info['phone'] ?></td>
                            <td><?= $info['email'] ?></td>
                            <td><?= $info['password'] ?></td>
                            <td><?= $info['business_name'] ?></td>
                            <td><?= $info['business_type'] ?></td>
                            <td><?= $info['business_location'] ?></td>
                            <td><?= $info['start_year'] ?></td>
                            <td><?= $info['registration_no'] ?></td>
                            <td><?= $info['turnover'] ?></td>
                            <td><a href="<?= $info['nid_file'] ?>" target="_blank">View</a></td>
                            <td><a href="<?= $info['trade_license'] ?>" target="_blank">View</a></td>
                            <td><a href="<?= $info['tin_cert'] ?>" target="_blank">View</a></td>
                            <td><a href="<?= $info['product_image'] ?>" target="_blank">View</a></td>
                            <td><img src="<?= $info['profile_pic'] ?>" alt="Profile Pic" style="width: 50px; height: 50px;"></td>
                            <td><?= nl2br(htmlspecialchars($info['motivation'])) ?></td>
                            <td><a href="<?= $info['facebook'] ?>" target="_blank">FB</a></td>
                            <td><a href="<?= $info['instagram'] ?>" target="_blank">IG</a></td>
                            <td><a href="<?= $info['website'] ?>" target="_blank">Web</a></td>
                            <td><?= $info['team_size'] ?></td>
                            <td><?= $info['reference'] ?></td>
                            <td><a href="add_entrepreneur.php?=<?= $info['id'] ?>" class="btn btn-primary">Add</a></td>
                            <td><a href="delete.php?entrepreneur_id=<?= $info['id'] ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </center>
    </div>
</body>

</html>