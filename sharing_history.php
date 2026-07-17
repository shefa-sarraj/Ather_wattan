<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'connection.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heritage_type = $_POST['heritage_type'] ?? '';
    $city_name = $_POST['city'] ?? '';
    $story_text = $_POST['story_text'] ?? '';
    
    // رفع الصورة
    $image_path = '';
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $image_name = time() . '_' . $_FILES['fileInput']['name'];
        $image_path = $upload_dir . $image_name;
        move_uploaded_file($_FILES['fileInput']['tmp_name'], $image_path);
    }
    
    // جلب city_id من اسم المدينة
    $city_sql = "SELECT id FROM cities WHERE name = '$city_name'";
    $city_result = $conn->query($city_sql);
    $city_id = null;
    if ($city_result->num_rows > 0) {
        $city_row = $city_result->fetch_assoc();
        $city_id = $city_row['id'];
    }
    
    if ($city_id) {
        $sql = "INSERT INTO user_contributions (user_id, city_id, content_type, content, image, status) 
                VALUES (1, $city_id, '$heritage_type', '$story_text', '$image_path', 'pending')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "✅ تم إرسال مشاركتك بنجاح! شكراً لك على إثراء التراث الفلسطيني.";
            $message_type = "success";
        } else {
            $message = "❌ حدث خطأ: " . $conn->error;
            $message_type = "error";
        }
    } else {
        $message = "❌ المدينة غير موجودة في قاعدة البيانات";
        $message_type = "error";
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
    <title>أثر وطن - شارك تراثك</title>
    <link rel="icon" type="image/png" href="images/logos.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sharing athar.css">

</head>

<body>

    <div class="container">
        
        <!-- رسالة النجاح أو الخطأ -->
        <?php if($message != ''): ?>
        <div style="background: <?php echo $message_type == 'success' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $message_type == 'success' ? '#155724' : '#721c24'; ?>; padding: 15px; margin: 20px auto; border-radius: 10px; text-align: center; max-width: 800px;">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
        
        <form method="POST" action="sharing_history.php" enctype="multipart/form-data">
            <!-- Header -->
            <header>
                <div class="logo">
                    <a href="index.php"><img src="images/logos.png" alt="أثر وطن"></a>
                </div>
                <div class="menu">
                    <button type="button" id="mobileMenuBtn">
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
            
            <div class="top-header">
                <h1>&hearts; شارك تراثك الفلسطيني &hearts;</h1>
                <p>حكايتك تضاف إلى ذاكرة الحجر</p>
            </div>
            
            <label>
                <img src="images/camera.png" alt="نوع التراث">
                نوع التراث:       
            </label>
            <div class="radio-group">
                <label><input type="radio" name="heritage_type" value="قصة شعبية" checked> قصة شعبية</label>
                <label><input type="radio" name="heritage_type" value="وصفة أكل"> وصفة أكل</label>
                <label><input type="radio" name="heritage_type" value="صورة حجر/تطريز"> صورة حجر/تطريز</label>
                <label><input type="radio" name="heritage_type" value="موسيقى تراثية"> موسيقى تراثية</label>
                <label><input type="radio" name="heritage_type" value="حرف يدوية"> حرف يدوية</label>
            </div>
            
            <div class="form-cities">
                <label>
                    <img src="images/cities.png" alt="المدينة">
                    المدينة:                
                </label>
                <select name="city">
                    <?php
                    $cities_sql = "SELECT name FROM cities ORDER BY name";
                    $cities_result = $conn->query($cities_sql);
                    if ($cities_result->num_rows > 0) {
                        while($city_row = $cities_result->fetch_assoc()) {
                            echo '<option value="' . $city_row['name'] . '">' . $city_row['name'] . '</option>';
                        }
                    } else {
                        $static_cities = ['القدس', 'غزة', 'يافا', 'حيفا', 'قلقيلية', 'الخليل', 'بيت لحم', 'جنين', 'طول كرم', 'أريحا', 'رام الله', 'سلفيت', 'طوباس', 'بيت جالا', 'بيت ساحور'];
                        foreach($static_cities as $static_city) {
                            echo '<option value="' . $static_city . '">' . $static_city . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="report-sharing">
                <label>
                    <img src="images/pen.png" alt="شارك النص">
                    شارك النص أو الحكاية:            
                </label>
                <textarea name="story_text" placeholder="اكتب هنا...." rows="6"></textarea>
            </div>
            
            <div class="img">
                <label>
                    <img src="images/picture.png" alt="رفع صورة">
                    أو ارفع صورة:
                </label>
                <label class="uploud-btn" for="fileInput">
                    <div class="icon"><img src="images/link.png" alt="اختر ملف"></div>
                    <span>اختر ملف</span>
                </label>
                <input type="file" name="fileInput" id="fileInput">
            </div>
            
            <button type="submit" class="btn" name="submit">أرسل مشاركتي</button>
            
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
        </form>
    </div>
    
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            var navbar = document.querySelector('.navbarr');
            navbar.classList.toggle('show');
        });
        
        // عرض اسم الملف عند اختياره
        document.getElementById('fileInput').addEventListener('change', function(e) {
            if(e.target.files.length > 0) {
                const fileName = e.target.files[0].name;
                const span = document.querySelector('.uploud-btn span');
                if(span) span.textContent = fileName.length > 20 ? fileName.substring(0, 17) + '...' : fileName;
            }
        });
    </script>
</body>
</html>