<?php
session_start();
include 'connection.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($username) || empty($email) || empty($password)) {
        $error_message = "الرجاء ملء جميع الحقول";
    } elseif ($password != $confirm_password) {
        $error_message = "كلمة المرور وتأكيدها غير متطابقين";
    } else {
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $conn->query($check_sql);
        
        if ($check_result->num_rows > 0) {
            $error_message = "البريد الإلكتروني موجود مسبقاً";
        } else {
            $sql = "INSERT INTO users (username, email, password) 
                    VALUES ('$username', '$email', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                $success_message = "✅ تم إنشاء الحساب بنجاح! <a href='login.php' style='color: green; font-weight: bold;'>اضغط هنا لتسجيل الدخول</a>";
            } else {
                $error_message = "خطأ: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - أثر وطن</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <img src="images/logos.png" class="logo" alt="أثر وطن">
        <h2>إنشاء حساب جديد</h2>
        
        <?php if($success_message != ''): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center;">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if($error_message != ''): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <form action="register.php" method="POST">
            <label>اسم المستخدم</label>
            <input type="text" name="username" required>
            
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" required>
            
            <label>كلمة المرور</label>
            <input type="password" name="password" required>
            
            <label>تأكيد كلمة المرور</label>
            <input type="password" name="confirm_password" required>  
            
            <button type="submit" name="submit">إنشاء حساب</button>            
        </form>
        
        <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
    </div>
</body>
</html>