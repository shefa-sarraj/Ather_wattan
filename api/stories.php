<?php
include 'connection.php';

// الحصول على id المدينة من الرابط
$city_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// جلب بيانات المدينة
$city_sql = "SELECT * FROM cities WHERE id = $city_id";
$city_result = $conn->query($city_sql);
$city = $city_result->fetch_assoc();

if (!$city) {
    die("المدينة غير موجودة");
}

// جلب القصص الخاصة بالمدينة من جدول city_stories
$stories_sql = "SELECT * FROM city_stories WHERE city_id = $city_id";
$stories_result = $conn->query($stories_sql);
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
    <title>قصص <?php echo $city['name']; ?> - أثر وطن</title>
    <link rel="icon" type="image/png" href="images/logos.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style3.css">
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

        <main>
            <!-- القائمة الداخلية -->
            <nav class="bnavbarr">
                <ul>
                    <li><a href="about.php?id=<?php echo $city_id; ?>">عن المدينة</a></li>
                    <li><a href="food.php?id=<?php echo $city_id; ?>">أشهر أكلاتها</a></li>
                    <li><a href="heritage.php?id=<?php echo $city_id; ?>">تراث المدينة</a></li>
                    <li><a href="stories.php?id=<?php echo $city_id; ?>" style="color: #b1151c;">القصص الشعبية</a></li>
                </ul>
            </nav>

            <h1>"في كل حكاية.. فلسطين"</h1>

            <?php if ($stories_result->num_rows > 0): ?>
                <?php while($story = $stories_result->fetch_assoc()): ?>
                    <div class="cards-grid">
                        <div class="card">
                            <?php if (!empty($story['image'])): ?>
                                <img src="images/<?php echo $story['image']; ?>" alt="<?php echo $story['story_title']; ?>">
                            <?php else: ?>
                                <img src="images/default-story.jpg" alt="قصة شعبية">
                            <?php endif; ?>
                            <div class="story-container">
                                <h2><?php echo $story['story_title']; ?></h2>
                                <p class="story-text">
                                    <?php 
                                    // عرض أول 100 حرف كملخص
                                    $short_text = mb_substr($story['story_text'], 0, 100);
                                    echo $short_text . '...';
                                    ?>
                                    <span class="more-text" style="display:none;"><?php echo $story['story_text']; ?></span>
                                </p>
                            </div>
                                <button class="btn-card" onclick="toggleStory(this)">
                                    اقرا القصة
                                </button> 
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center; padding:50px 0;">لا توجد قصص مسجلة لهذه المدينة حالياً</p>
            <?php endif; ?>

        </main>

        <!-- Footer -->
      <footer>
            <div class="footer-top" id="conect">
                <div class="logo">
                <div class="logo"><a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a></div>
                </div>
                <nav class="navbarr">
                    <ul>
                        <li><a href="index.html">الرئيسية</a></li>
                        <li><a href="city.html"  style="color: #b1151c;">المدن</a></li>
                        <li><a href="index1.html" >المعالم</a></li>
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

    </div>

    <script src="js/script.js"></script>
    <script>
        // دالة إظهار/إخفاء النص الكامل
function toggleStory(button) {
    const card = button.closest('.card');
    const moreText = card.querySelector('.more-text');

    if (moreText.style.display === 'none' || moreText.style.display === '') {
        moreText.style.display = 'inline';
        button.innerText = 'إخفاء القصة';
    } else {
        moreText.style.display = 'none';
        button.innerText = 'اقرأ القصة';
    }
}

        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            var navbar = document.querySelector('.navbarr');
            navbar.classList.toggle('show');
        });
    </script>
</body>
</html>