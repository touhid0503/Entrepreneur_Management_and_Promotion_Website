<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:admin_login.php");
} else if ($_SESSION['usertype'] == 'us') {
    header("location:admin_login.php");
}

?>
<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>উদ্যোক্তা যুক্ত করুন</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-green-700">উদ্যোক্তা যুক্ত করুন</h1>

        <form action="sub_ent.php" method="POST" enctype="multipart/form-data" class="space-y-6">

            <!-- ব্যক্তিগত তথ্য -->
            <div>
                <h2 class="text-xl font-semibold mb-4 text-gray-700">১. ব্যক্তিগত তথ্য</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="full_name" placeholder="পুরো নাম" class="input" required>
                    <input type="date" name="dob" placeholder="জন্মতারিখ" class="input" required>
                    <input type="text" name="nid_passport" placeholder="জাতীয় পরিচয়পত্র/পাসপোর্ট নম্বর" class="input" required>
                    <input type="text" name="present_address" placeholder="বর্তমান ঠিকানা" class="input" required>
                    <input type="text" name="permanent_address" placeholder="স্থায়ী ঠিকানা" class="input" required>
                    <input type="tel" name="phone" placeholder="মোবাইল নম্বর" class="input" required>
                    <input type="email" name="email" placeholder="ইমেইল" class="input" required>
                    <input type="password" name="password" placeholder="পাসওয়ার্ড" class="input" required>
                    <div class="md:col-span-2">
                        <label for="profile_pic" class="block mb-1 font-medium text-gray-600">প্রোফাইল ছবি <span class="text-red-500">*</span></label>
                        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" class="input" required>
                    </div>

                </div>

                <!-- ব্যবসার তথ্য -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">২. ব্যবসার তথ্য</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="business_name" placeholder="ব্যবসার নাম" class="input" required>
                        <input type="text" name="business_type" placeholder="ব্যবসার ধরন" class="input" required>
                        <input type="text" name="business_location" placeholder="অবস্থান (ঠিকানা/লিংক)" class="input" required>
                        <input type="text" name="start_year" placeholder="ব্যবসা শুরু করার বছর" class="input" required>
                        <input type="text" name="registration_no" placeholder="ব্যবসার রেজিস্ট্রেশন নম্বর" class="input">
                        <input type="text" name="turnover" placeholder="মাসিক আয় বা টার্নওভার (ঐচ্ছিক)" class="input">
                    </div>
                </div>

                <!-- কাগজপত্র -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">৩. কাগজপত্র (আপলোড)</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="nid_file" class="block mb-1 font-medium text-gray-600">জাতীয় পরিচয়পত্র (NID) <span class="text-red-500">*</span></label>
                            <input type="file" name="nid_file" id="nid_file" class="input" required>
                        </div>
                        <div>
                            <label for="trade_license" class="block mb-1 font-medium text-gray-600">ট্রেড লাইসেন্স (যদি থাকে)</label>
                            <input type="file" name="trade_license" id="trade_license" class="input">
                        </div>
                        <div>
                            <label for="tin_cert" class="block mb-1 font-medium text-gray-600">TIN সার্টিফিকেট (ঐচ্ছিক)</label>
                            <input type="file" name="tin_cert" id="tin_cert" class="input">
                        </div>
                        <div>
                            <label for="product_image" class="block mb-1 font-medium text-gray-600">ব্যবসায়িক লোগো / প্রোডাক্ট ফটোগ্রাফ</label>
                            <input type="file" name="product_image" id="product_image" class="input">
                        </div>
                    </div>
                </div>


                <!-- মোটিভেশন -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">৪. মোটিভেশন বা উদ্দেশ্য</h2>
                    <textarea name="motivation" rows="4" placeholder="এই প্ল্যাটফর্মে যুক্ত হয়ে আমি কী করতে চাই?" class="input w-full" required></textarea>
                </div>

                <!-- সামাজিক মাধ্যম -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">৫. সামাজিক মাধ্যম / ওয়েবসাইট</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="url" name="facebook" placeholder="ফেসবুক পেজ লিংক" class="input">
                        <input type="url" name="instagram" placeholder="ইনস্টাগ্রাম লিংক" class="input">
                        <input type="url" name="website" placeholder="ওয়েবসাইট / ই-কমার্স" class="input">
                    </div>
                </div>

                <!-- টিম ও রেফারেন্স -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">৬. টিম / রেফারেন্স</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="number" name="team_size" placeholder="কর্মী সংখ্যা (ঐচ্ছিক)" class="input">
                        <input type="text" name="reference" placeholder="কে সুপারিশ করেছেন?" class="input">
                    </div>
                </div>

                <br>
                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 text-lg">
                        যুক্ত করুন
                    </button>
                </div>
        </form>
    </div>

    <!-- Tailwind custom styles -->
    <!-- <style>
        .input {
            @apply w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500;
        }
    </style> -->
</body>

</html>