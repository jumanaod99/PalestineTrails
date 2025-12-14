<?php
session_start();

// حذف كل بيانات الجلسة
session_unset();
session_destroy();

// رجوع لصفحة الرئيسية
header("Location: index.php");
exit;
