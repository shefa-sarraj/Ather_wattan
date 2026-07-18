<?php
include 'connection.php';

// الحصول على id المدينة من الرابط
$city_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// جلب بيانات المدينة من جدول cities
$city_sql = "SELECT * FROM cities WHERE id = $city_id";
$city_result = $conn->query($city_sql);
$city = $city_result->fetch_assoc();

if (!$city) {
    die("المدينة غير موجودة");
}

// جلب المعلومات الإضافية من city_info
$info_sql = "SELECT * FROM city_info WHERE city_id = $city_id";
$info_result = $conn->query($info_sql);
$info = $info_result->fetch_assoc();

// دالة لاستخراج رقم الفيديو من رابط يوتيوب
function getYoutubeID($url) {
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    preg_match($pattern, $url, $matches);
    return isset($matches[1]) ? $matches[1] : '';
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
    <title>أثر وطن - <?php echo $city['name']; ?></title>
    <link rel="icon" type="image/png" href="images/logos.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/city.css">
    <link rel="stylesheet" href="assets/css/city.css">
    <link rel="stylesheet" href="assets/css/city.css">
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
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="city.php" style="color: #b1151c;">المدن</a></li>
                    <li><a href="index1.php">المعالم</a></li>
                    <li><a href="sharing_history.php">شارك تراثك</a></li>
                </ul>
            </nav>
            <a href="#conect" class="btn-contact">تواصل معنا</a>
        </header>

        <!-- القائمة الداخلية (عن المدينة، أكلات، تراث، قصص) -->
      <nav class="bnavbarr">
 <nav class="bnavbarr">
    <ul>
        <li><a href="about.php?id=<?php echo $city_id; ?>" style="color: #b1151c; text-decoration: none;">عن المدينة</a></li>
        <li><a href="food.php?id=<?php echo $city_id; ?>" style="color: black; text-decoration: none;">أشهر أكلاتها</a></li>
        <li><a href="heritage.php?id=<?php echo $city_id; ?>" style="color: black; text-decoration: none;">تراث المدينة</a></li>
        <li><a href="stories.php?id=<?php echo $city_id; ?>" style="color: black; text-decoration: none;">القصص الشعبية</a></li>
    </ul>
</nav>

        <main>

            <!-- Section Title -->
            <section class="section-heading">
                <div class="title-row">
                    <h2 style="color: #b1151c;">مدينة <?php echo $city['name']; ?></h2>
                </div>
                <p><?php echo $info ? $info['brief_history'] : 'لا توجد معلومات متاحة حالياً'; ?></p>
            </section>

            <!-- فيديو المدينة -->
            <?php if (!empty($city['video_link'])): ?>
                <div class="video-section">
                    <h2 class="video-title" style="margin-bottom: 40px; text-align: right;">
                        <?php echo !empty($city['video_title']) ? $city['video_title'] : 'فيديو عن المدينة'; ?>
                    </h2>
                    <a href="<?php echo $city['video_link']; ?>" target="_blank" class="video-wrapper" style="display: block; position: relative; width: 100%;">
                        <img src="https://img.youtube.com/vi/<?php echo getYoutubeID($city['video_link']); ?>/maxresdefault.jpg" alt="Video Thumbnail" class="video-thumb" style="width: 100%; border-radius: 10px;">
                        <div class="play-button" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10;">
                            <i class="fas fa-play-circle" style="font-size: 60px; color: #fff; text-shadow: 0 4px 8px rgba(0,0,0,0.3);"></i>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

        </main>

    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-top" id="conect">
            <div class="logo">
                <a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a>
            </div>
            <nav class="navbarr">
                <ul>
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="city.php" style="color: #b1151c;">المدن</a></li>
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

    <script src="js/script.js"></script>
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            var navbar = document.querySelector('.navbarr');
            navbar.classList.toggle('show');
        });
    </script>
</body>
</html>