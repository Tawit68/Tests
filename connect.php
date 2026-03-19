<?php
$servername = "localhost";// กำหนดชื่อเซิร์ฟเวอร์ (ส่วนใหญ่ localhost คือเครื่องตัวเอง)
$username ="root";
$password = "";
$dbname = "tests";// ชื่อฐานข้อมูลที่ต้องการเชื่อมต่อ

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successfully";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
