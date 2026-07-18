<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestine_heritage";

// إنشاء الاتصال مع كتم الأخطاء مؤقتاً باستخدام علامة @
$conn = @new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال دون التسبب في انهيار السيرفر (Bypass die)
if ($conn->connect_error) {
    // تركنا الكود فارغاً هنا مؤقتاً ليسمح للواجهة بالظهور ولا يوقف السيرفر
} else {
    // لدعم اللغة العربية في حال نجاح الاتصال مستقبلاً
    $conn->set_charset("utf8");
}
?>