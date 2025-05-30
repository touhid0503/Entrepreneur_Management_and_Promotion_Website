<?php
error_reporting(0);
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['message'] = "Please log in first.";
    header("Location: login.php");
    exit();
}

// Show alert if message is set
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('$message');</script>";
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>উদ্যোক্তা</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center p-6">

    <?php include('navbar.html'); ?>

    <!-- Navbar -->
    <section id="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.html">
                        <img src="images/logo/Gemini_Generated_Image_19usca19usca19us.png" alt="logo">
                    </a>
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                        <li><a href="entrepreneur_login.php">Entrepreneur</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </section>

    <!-- Category Section -->
    <h1 class="text-3xl font-bold mb-8 mt-8">উদ্যোক্তা শ্রেণী</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-6xl">
        <a href="category_selection1.php"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/categories/mason.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">রাজমিস্ত্রি</span>
            </div>
        </a>

        <a href="category_selection2.php"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/categories/electrician.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">ইলেকট্রিশিয়ান</span>
            </div>
        </a>

        <a href="category_selection3.php"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/categories/event.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">ইভেন্ট ম্যানেজমেন্ট</span>
            </div>
        </a>

        <a href="category_selection4.php"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/categories/clothing.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">পোশাক</span>
            </div>
        </a>

        <a href="category_selection5.php"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/categories/gym.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">জিমনেসিয়াম</span>
            </div>
        </a>

        <a href="category_selection6.php"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/categories/contractor.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">ঠিকাদার</span>
            </div>
        </a>
    </div>

    </div> <!-- End of category grid -->

    <!-- Entrepreneur Registration Prompt -->
    <div class="text-center mt-10">
        <h2 class="text-2xl font-semibold mb-4">আপনি কি উদ্যোক্তা হতে চান?</h2>
        <a href="entrepreneur_registration.php"
            class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg text-lg font-medium hover:bg-green-700 transition">
            রেজিস্ট্রেশন করুন
        </a>
    </div>

    <!-- Footer -->
    <br><br>
    <footer class="w-full bg-black text-white text-center py-6 mt-10">
        <h3 class="text-lg">All &copy; copyright reserved by উদ্যোক্তা</h3>
    </footer>


</body>

</html>