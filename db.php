<?php
// الاتصال بقاعدة البيانات
$host = "localhost";     // السيرفر
$user = "root";          // اسم مستخدم MySQL
$password = "";              // الباسوورد (فاضي في XAMPP)
$database  = "palestine_trails";  // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($host, $user, $password, $database);

// فحص الاتصال
if ($conn->connect_errno) {
    die("connection failed: ". $conn->connect_error);
}
?>

