<?php
include 'connection.php';
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
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

<div class="container">

    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a>
        </div>

        <div class="menu">
            <button id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav class="navbarr">
            <ul>
                <li><a href="index.php" style="color:#b1151c;">الرئيسية</a></li>
                <li><a href="city.php">المدن</a></li>
                <li><a href="index1.php">المعالم</a></li>
                <li><a href="sharing_history.php">شارك تراثك</a></li>
            </ul>
        </nav>

        <a href="#conect" class="btn-contact">تواصل معنا</a>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-section">
            <div class="content">
                <h1>هل مستعد لرحلة تأخذك الى قلب التراث الفلسطيني؟</h1>
                <h3>لتتعرف على حكاية وطن لا يموت</h3>
                <button class="btn" onclick="window.location.href='#cities'">استكشف معنا</button>
                <h2>موقع "أثر وطن" في احياء التراث الفلسطيني</h2>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features-container">
        <div class="features-grid">
            <div class="card">
                <h3>ماذا نقدم؟</h3>
                <p>يسعى موقع أثر وطن الى جمع وحماية التراث الفلسطيني المادي واللامادي وتقديمه بصورة عصرية وموثوقة لتكون مرجعاً رقمياً لكل فلسطيني مهتم بالهوية الفلسطينية</p>
            </div>
            <div class="card">
                <h3>توثيق التراث الفلسطيني</h3>
                <p>نعمل على توثيق التفاصيل الدقيقة للمدن الفلسطينية اكلاتها و ازيائها و حرفها اليدوية استناداً إلى مصادر موثوقة و مراجع تاريخية</p>
            </div>
            <div class="card">
                <h3>حفظ الهوية والذاكرة</h3>
                <p>نعيد ربط الأجيال الجديدة بتراث بلدهم و نساهم في حفظ الذاكرة الفلسطينية من الاندثار عبر محتوى رقمي مرئي و نصي يليق بعظمة هذا التراث</p>
            </div>
            <div class="card">
                <h3>مصادر موثوقة</h3>
                <p>تعتمد في محتواها على كتب التراث و الدراسات الأكاديمية و مقابلات شفهية مع كبار السن لضمان دقة المعلومات و توثيقها بشكل علمي</p>
            </div>
        </div>
    </section>

    <!-- Cities -->
    <section class="container2" id="cities">

        <h2><b>كل مدينة تحمل وطناً... اختر رحلتك</b></h2>

        <!-- القدس -->
        <div class="city-card">
            <div class="contents">
                <p><b>القدس</b> مدينة تاريخية عظيمة، تحتضن المسجد الأقصى وقبة الصخرة، وتمتزج فيها عراقة التاريخ بقداسة الأماكن المقدسة.</p>
                <a href="about.php?id=1" class="btn">استكشف معنا</a>
            </div>
            <div class="image-box">
                <img src="images/jerosalem.png" alt="القدس">
            </div>
        </div>

        <!-- غزة -->
        <div class="city-card">
            <div class="contents">
                <p><b>غزة</b> مدينة البحر والتاريخ، عرفت بالصمود والعطاء، وتضم ميناءً عريقاً وشواطئ جميلة.</p>
                <a href="about.php?id=14" class="btn">استكشف معنا</a>
            </div>
            <div class="image-box">
                <img src="images/gaza.png" alt="غزة">
            </div>
        </div>

        <!-- نابلس -->
        <div class="city-card">
            <div class="contents">
                <p><b>نابلس</b> جوهرة فلسطين، تشتهر بالكنافة والصابون النابلسي، وتقع بين جبل عيبال وجبل جرزيم.</p>
                <a href="heritage.php?id=16" class="btn">استكشف معنا</a>
            </div>
            <div class="image-box">
                <img src="images/nablus.png" alt="نابلس">
            </div>
        </div>

    </section>

    <!-- Video -->
    <section class="video-section">
        <h1 class="video-title"><b>تعرف على تراثنا الفلسطيني في فيديو واحد</b></h1>

        <div class="video-placeholder">
            <video controls poster="images/athar.png">
                <source src="https://youtu.be/Rv8_LkqpkLA" type="video/mp4">
            </video>
        </div>
    </section>

</div>

<!-- Footer -->
<footer>
    <div class="footer-top" id="conect">
        <div class="logo">
            <a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a>
        </div>
        <nav class="navbarr">
            <ul>
                <li><a href="index.php" style="color: #b1151c;">الرئيسية</a></li>
                <li><a href="city.php">المدن</a></li>
                <li><a href="index1.php">المعالم</a></li>
                <li><a href="sharing_history.php">شارك تراثك</a></li>
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

<script src="assets/js/script.js"></script>

</body>
</html>