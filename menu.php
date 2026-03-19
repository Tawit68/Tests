<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include "connect.php"; session_start(); ?> /
<!-- รียกไฟล์เชื่อมฐานข้อมูล (มี $conn) -->

<h2> เมนูอาหาร</h2>
<!-- แสดงหัวข้อหน้า -->

<table border="1">
<tr>
    <th>ชื่อเมนู</th>
    <th>ราคา</th>
    <th>เพิ่ม</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM food");
// สั่ง SQL ไปที่ database เอาข้อมูลจากตาราง food ทั้งหมด

while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
    // fetch() → ดึงข้อมูลทีละแถวPDO::FETCH_ASSOC → ดึงแบบ associative array
?>
<tr>
    <td><?= $row['Foodname'] ?></td>
    <td><?= $row['price'] ?> บาท</td>
    <!-- echo แบบสั้นแสดงชื่อเมนู + ราคา -->
    <td>
        <form method="POST" action="cart.php">
            <input type="hidden" name="FoodID" value="<?= $row['FoodID'] ?>">
            <button name="add">เพิ่ม</button>
        </form>
        <!-- ส่งข้อมูลไป cart.phpส่ง FoodID แบบ hidden -->
    </td>
</tr>
<?php } ?>
<!-- จบ while loop -->
</table>

<br>
<a href="cart.php"> ดูตะกร้า</a>


    
</body>
</html>