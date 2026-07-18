<?php
include 'connection.php';

$city_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// جلب بيانات المدينة (الاسم فقط)
$city_sql = "SELECT * FROM cities WHERE id = $city_id";
$city_result = $conn->query($city_sql);
$city = $city_result->fetch_assoc();

if (!$city) {
    die("المدينة غير موجودة");
}

// جلب الأكلات مع page_title و page_description من city_food
$food_sql = "SELECT * FROM city_food WHERE city_id = $city_id";
$food_result = $conn->query($food_sql);

// جلب page_title و page_description من أول سجل (لأنها نفسها لكل أكلات المدينة)
$first_food = $food_result->fetch_assoc();
$page_title = $first_food['page_title'] ?? 'المطبخ في ' . $city['name'];
$page_description = $first_food['page_description'] ?? '';

// إعادة تعيين المؤشر لعرض الأكلات
$food_result->data_seek(0);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أكلات <?php echo $city['name']; ?> - أثر وطن</title>
    <link rel="icon" type="image/png" href="images/logos.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/city history.css">
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

        <nav class="bnavbarr">
            <ul>
                <li><a href="about.php?id=<?php echo $city_id; ?>">عن المدينة</a></li>
                <li><a href="food.php?id=<?php echo $city_id; ?>" style="color: #b1151c;">أشهر أكلاتها</a></li>
                <li><a href="heritage.php?id=<?php echo $city_id; ?>">تراث المدينة</a></li>
                <li><a href="stories.php?id=<?php echo $city_id; ?>">القصص الشعبية</a></li>
            </ul>
        </nav>

        <section class="hertage-gellery">
            <div class="gellery-container">
                <h2 class="main-title"><?php echo $page_title; ?></h2>
                <?php if (!empty($page_description)): ?>
                    <p class="sub-title"><?php echo $page_description; ?></p>
                <?php endif; ?>
            </div>
        </section>

<div class="hertage-grid">
    <?php if ($food_result->num_rows > 0): ?>
        <?php while($food = $food_result->fetch_assoc()): ?>
            <div class="hertage-card">
                <?php if (!empty($food['image'])): ?>
                    <img src="images/<?php echo $food['image']; ?>" alt="<?php echo $food['dish_name']; ?>">
                <?php else: ?>
                    <img src="images/default-food.jpg" alt="طعام تراثي">
                <?php endif; ?>
                <h3><?php echo $food['dish_name']; ?></h3>
                <p><?php echo $food['dish_description']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; width:100%;">لا توجد أكلات مسجلة لهذه المدينة حالياً</p>
    <?php endif; ?>
</div>

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
    </div>

    <script src="js/script.js"></script>
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            var navbar = document.querySelector('.navbarr');
            navbar.classList.toggle('show');
        });
    </script>
</body>
</html>