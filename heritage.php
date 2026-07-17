<?php
include 'connection.php';

$city_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$city_sql = "SELECT * FROM cities WHERE id = $city_id";
$city_result = $conn->query($city_sql);
$city = $city_result->fetch_assoc();

if (!$city) {
    die("المدينة غير موجودة");
}

$heritage_sql = "SELECT * FROM city_heritage WHERE city_id = $city_id";
$heritage_result = $conn->query($heritage_sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تراث <?php echo $city['name']; ?> - أثر وطن</title>
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
                <li><a href="food.php?id=<?php echo $city_id; ?>">أشهر أكلاتها</a></li>
                <li><a href="heritage.php?id=<?php echo $city_id; ?>" style="color: #b1151c;">تراث المدينة</a></li>
                <li><a href="stories.php?id=<?php echo $city_id; ?>">القصص الشعبية</a></li>
            </ul>
        </nav>

        <?php if ($heritage_result->num_rows > 0): ?>
            <?php 
            $groups = [];
            while($row = $heritage_result->fetch_assoc()) {
                $key = $row['page_title'] . '|||' . $row['page_description'];
                if (!isset($groups[$key])) {
                    $groups[$key] = [
                        'page_title' => $row['page_title'],
                        'page_description' => $row['page_description'],
                        'items' => []
                    ];
                }
                $groups[$key]['items'][] = $row;
            }
            ?>

            <?php foreach ($groups as $group): ?>
                <section class="hertage-gellery">
                    <div class="gellery-container">
                        <h2 class="main-title"><?php echo $group['page_title']; ?></h2>
                        <?php if (!empty($group['page_description'])): ?>
                            <p class="sub-title"><?php echo $group['page_description']; ?></p>
                        <?php endif; ?>
                    </div>
                </section>

                <div class="hertage-grid">
                    <?php foreach ($group['items'] as $item): ?>
                        <div class="hertage-card">
                            <?php if (!empty($item['image'])): ?>
                                <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['heritage_title']; ?>">
                            <?php else: ?>
                                <img src="images/default-heritage.jpg" alt="تراث فلسطيني">
                            <?php endif; ?>
                            <h3><?php echo $item['heritage_title']; ?></h3>
                            <p><?php echo $item['heritage_description']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p style="text-align:center; padding:50px 0;">لا توجد عناصر تراثية مسجلة لهذه المدينة حالياً</p>
        <?php endif; ?>

        <footer>
            <div class="footer-top" id="conect">
                <div class="logo"><a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a></div>
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
            document.querySelector('.navbarr').classList.toggle('show');
        });
    </script>
</body>
</html>