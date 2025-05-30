<?php
session_start();
error_reporting(0);

// Database connection
$conn = new mysqli("127.0.0.1:3306", "root", "", "ent");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check login
if (!isset($_SESSION['username'])) {
    $_SESSION['message'] = "Please log in first.";
    header("Location: login.php");
    exit();
}

// Get URL parameters
$division = $_GET['division'] ?? '';
$type = $_GET['type'] ?? '';

if (empty($division) || empty($type)) {
    echo "<script>alert('Invalid parameters!'); window.location.href='category_selection.php';</script>";
    exit();
}

// Fetch entrepreneur data
$query = "SELECT * FROM entrepreneur_main WHERE business_location = ? AND business_type = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $division, $type);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($division); ?> - <?php echo htmlspecialchars(ucfirst($type)); ?> Entrepreneurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8 min-h-screen text-sm" style="zoom: 90%;">

    <h1 class="text-3xl font-bold text-center mb-10">
        <?php echo htmlspecialchars($division); ?> Division - <?php echo htmlspecialchars(ucfirst($type)); ?> Entrepreneurs
    </h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white shadow-lg rounded-xl p-4 flex flex-col">
                    <img src="<?php echo htmlspecialchars($row['profile_pic']); ?>" alt="Profile Picture"
                        class="w-full h-48 object-cover rounded-lg mb-4">

                    <h2 class="text-xl font-bold text-blue-800 mb-2"><?php echo htmlspecialchars($row['full_name']); ?></h2>
                    <p><strong>Business:</strong> <?php echo htmlspecialchars($row['business_name']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['business_location']); ?></p>
                    <p><strong>Start Year:</strong> <?php echo htmlspecialchars($row['start_year']); ?></p>
                    <p><strong>Team Size:</strong> <?php echo htmlspecialchars($row['team_size']); ?></p>
                    <p><strong>Motivation:</strong> <?php echo htmlspecialchars($row['motivation']); ?></p>

                    <!-- Social Links -->
                    <div class="flex flex-wrap gap-4 mt-2 mb-2 text-sm">
                        <?php if (!empty($row['facebook'])): ?>
                            <a href="<?php echo htmlspecialchars($row['facebook']); ?>" target="_blank"
                                class="text-blue-600 hover:underline">Facebook</a>
                        <?php endif; ?>
                        <?php if (!empty($row['instagram'])): ?>
                            <a href="<?php echo htmlspecialchars($row['instagram']); ?>" target="_blank"
                                class="text-pink-600 hover:underline">Instagram</a>
                        <?php endif; ?>
                        <?php if (!empty($row['website'])): ?>
                            <a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank"
                                class="text-green-600 hover:underline">Website</a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($row['reference'])): ?>
                        <p class="text-gray-500 text-xs"><strong>Reference:</strong> <?php echo htmlspecialchars($row['reference']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-700 text-lg mt-10">
            No entrepreneurs found for <?php echo htmlspecialchars($type); ?> in <?php echo htmlspecialchars($division); ?>.
        </p>
    <?php endif; ?>
</body>

</html>