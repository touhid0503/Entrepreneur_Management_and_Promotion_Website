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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Select Division - Electrician Entrepreneurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center p-6">

    <h1 class="text-3xl font-bold mb-8">আপনার বিভাগ নির্বাচন করুন (ইলেকট্রিশিয়ান)</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full max-w-5xl">

        <!-- Rajshahi -->
        <a href="filtered_profiles.php?division=Rajshahi&type=electrician"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/divisions/rajshahi.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">রাজশাহী</span>
            </div>
        </a>

        <!-- Dhaka -->
        <a href="filtered_profiles.php?division=Dhaka&type=electrician"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/divisions/dhaka.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">ঢাকা</span>
            </div>
        </a>

        <!-- Sylhet -->
        <a href="filtered_profiles.php?division=Sylhet&type=electrician"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/divisions/sylhet.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">সিলেট</span>
            </div>
        </a>

        <!-- Khulna -->
        <a href="filtered_profiles.php?division=Khulna&type=electrician"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/divisions/khulna.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">খুলনা</span>
            </div>
        </a>

        <!-- Barisal -->
        <a href="filtered_profiles.php?division=Barisal&type=electrician"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/divisions/barisal.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">বরিশাল</span>
            </div>
        </a>

        <!-- Chittagong -->
        <a href="filtered_profiles.php?division=Chittagong&type=electrician"
            class="relative w-full h-64 bg-cover bg-center rounded-xl shadow-lg overflow-hidden group"
            style="background-image: url('images/divisions/chittagong.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition duration-300"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-white text-2xl font-bold">চট্টগ্রাম</span>
            </div>
        </a>

    </div>

</body>

</html>