<?php
session_start();
include 'connection.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'] ?? '';
    $password = $_POST['Password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        // البحث عن المستخدم بالإيميل
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // التحقق من كلمة المرور (استخدم password_verify إذا كنت تشفريها)
            if ($password == $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                
                // تحويله إلى الصفحة الرئيسية
                header("Location: index.php");
                exit();
            } else {
                $error_message = "كلمة المرور غير صحيحة";
            }
        } else {
            $error_message = "البريد الإلكتروني غير موجود";
        }
    } else {
        $error_message = "الرجاء إدخال البريد الإلكتروني وكلمة المرور";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - أثر وطن</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <img src="images/logos.png" class="logo" alt="أثر وطن">
        <h2>تسجيل الدخول إلى حسابك</h2>
        
        <?php if($error_message != ''): ?>
            <div class="error-message" style="color: red; margin-bottom: 15px; text-align: center;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <label>البريد الإلكتروني</label>
            <input type="email" name="Email" required>
            
            <label>كلمة المرور</label>
            <input type="password" name="Password" required>  
            
            <button type="submit" name="submit">تسجيل الدخول</button>            
        </form>
        
        <p>ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a></p>
    </div>
</body>
</html>