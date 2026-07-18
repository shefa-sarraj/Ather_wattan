<?php
include 'connection.php';

// جلب جميع المدن من قاعدة البيانات
$sql = "SELECT * FROM cities";
$result = $conn->query($sql);
$cities = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>أثر وطن - معالم فلسطين</title>
    <link rel="icon" type="image/png" href="images/logos.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/city.css">
</head>
<body>

<div class="container">
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="#"><img src="images/logos.png" alt="أثر وطن"></a>
        </div>
        <div class="menu">
            <button id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav class="navbarr">
            <ul>
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="city.php" style="color: #b1151c;">المدن</a></li>
                <li><a href="index1.php">المعالم</a></li>
                <li><a href="sharing_history.php">شارك تراثك</a></li>
            </ul>
        </nav>
        <a href="#conect" class="btn-contact">تواصل معنا</a>
    </header>

    <h1>استكشف مدن فلسطين</h1>
    <h3 class="main-description">رحلة عبر المدن في تفاصيل الحجر و ذاكرة البحر و شموخ الجبال الفلسطينية التي لم تفقد بوصلتها أبدا</h3>

    <main class="slider-wrapper">
        <button class="nav-btn prev-btn" onclick="changeCity(-1)">&#10094;</button>
        <div id="city-container" class="city-container">
            <!-- البطاقات ستظهر من خلال JavaScript -->
        </div>
        <button class="nav-btn next-btn" onclick="changeCity(1)">&#10095;</button>
    </main>
</div>

<footer>
    <div class="footer-top" id="conect">
        <div class="logo">
            <a href="#"><img src="images/logos.png" alt="أثر وطن"></a>
        </div>
        <nav class="navbarr">
            <ul>
                <li><a href="index.html">الرئيسية</a></li>
                <li><a href="city.html" style="color: #b1151c;">المدن</a></li>
                <li><a href="index1.html">المعالم</a></li>
                <li><a href="sharing history.html">شارك تراثك</a></li>
            </ul>
        </nav>
    </div>
    <p>&copy; 2026 أثر وطن. جميع الحقوق محفوظة</p>
    <div class="social-links">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <span>athar-waten</span>
    </div>
</footer>

<script src="js/city.js"></script>
<script>
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        var navbar = document.querySelector('.navbarr');
        navbar.classList.toggle('show');
    });
</script>
</body>
</html>