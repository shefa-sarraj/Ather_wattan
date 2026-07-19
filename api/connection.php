<?php
$servername = "blaxdyjfxqxgu2ivmnip-mysql.services.clever-cloud.com";
$username = "uset8nkvjyvcnqm2";
$password = "NMQPAAlrgBNtQmMewFUN"; 
$dbname = "blaxdyjfxqxgu2ivmnip";

// إنشاء الاتصال السحابي الحقيقي
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات السحابية: " . $conn->connect_error);
}

// لدعم اللغة العربية بشكل صحيح
$conn->set_charset("utf8");
?>