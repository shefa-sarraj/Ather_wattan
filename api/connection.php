<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palestine_heritage";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

//لدعم اللغه العربيه
$conn->set_charset("utf8");

?>