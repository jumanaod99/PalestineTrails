<?php
// الاتصال بقاعدة البيانات
$host = "localhost";     // السيرفر
$user = "root";          // اسم مستخدم MySQL
$pass = "";              // الباسوورد (فاضي في XAMPP)
$db   = "palestinetrails";  // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($host, $user, $pass, $db);

// فحص الاتصال
if ($conn->connect_errno) {
    die("connection failed: " . $conn->connect_error);
}
?>

