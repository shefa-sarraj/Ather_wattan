<?php
session_start();
include 'connection.php';

// جلب جميع المشاركات المقبولة فقط (approved)
$sql = "SELECT uc.*, c.name as city_name, u.username 
        FROM user_contributions uc
        JOIN cities c ON uc.city_id = c.id
        JOIN users u ON uc.user_id = u.id
        WHERE uc.status = 'approved'
        ORDER BY uc.created_at DESC";
$result = $conn->query($sql);
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
    <title>أثر وطن - قصص المشاركين</title>
    <link rel="icon" type="image/png" href="images/logos.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sharing history.css">

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
                    <li><a href="index.php">المدن</a></li>
                    <li><a href="#">المعالم</a></li>
                    <li><a href="sharing_history.php" style="color: #b1151c;">شارك تراثك</a></li>
                </ul>
            </nav>
            <a href="#" class="btn-contact">تواصل معنا</a>
        </header>
        
        <h2 class="top-header">&hearts; تراثنا هويتنا... &hearts;</h2>
        
        <div class="main-wrapper">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
<div class="heritage-card">
    <div class="card-content">
        <h1 class="hero-title">
            <span class="highlight-red">شكراً لك</span> 
            يا <?php echo htmlspecialchars($row['username']); ?>
        </h1>
        <p class="main-paragraph">
            <b>تم استقبال مشاركتك الثرية القيمة في <span class="highlight-red">"<?php echo htmlspecialchars($row['city_name']); ?>"</span>
            <br>أثرك الآن محفور في ذاكرة الوطن</b>
        </p>
        
        <!-- هاي القسم لازم يكون داخل card-content -->
        <div class="contribution-details">
            <p><strong>نوع التراث:</strong> <?php echo htmlspecialchars($row['content_type']); ?></p>
            <p><strong>المحتوى:</strong> <?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
            <?php if($row['image']): ?>
                <div class="contribution-image">
                    <img src="<?php echo $row['image']; ?>" alt="مشاركة" style="max-width: 200px; border-radius: 10px; margin-top: 10px;">
                </div>
            <?php endif; ?>
            <p class="contribution-date"><small>تاريخ الإرسال: <?php echo date('d/m/Y', strtotime($row['created_at'])); ?></small></p>
        </div>
        <!-- انتهى القسم -->
        
    </div>
    <div class="card-footer">
        <div class="stitch-info">
            "<?php echo htmlspecialchars($row['content_type']); ?>"<br>
            غرزة تحكي قصة ثبات <?php echo htmlspecialchars($row['city_name']); ?>
        </div>
        <img src="images/logo.jpeg" alt="torath logo" class="footer-logo">
    </div>
</div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="heritage-card">
                    <div class="card-content">
                        <h1 class="hero-title">لا توجد مشاركات بعد</h1>
                        <p class="main-paragraph">كن أول من يشارك تراثه الفلسطيني!</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <footer>
            <div class="footer-top">
                <div class="logo">
                    <a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a>
                </div>
                <nav class="navbarr">
                    <ul>
                        <li><a href="index.php">الرئيسية</a></li>
                        <li><a href="index.php">المدن</a></li>
                        <li><a href="#">المعالم</a></li>
                        <li><a href="sharing_history.php" style="color: #b1151c;">شارك تراثك</a></li>
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
    
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            var navbar = document.querySelector('.navbarr');
            navbar.classList.toggle('show');
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>