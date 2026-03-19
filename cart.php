<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "connect.php"; session_start(); ?>

<?php
// เพิ่มสินค้า
if (isset($_POST['add'])) {
    $id = $_POST['FoodID'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

// ลบสินค้า
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}
?>

<h2> รายการสั่งอาหาร</h2>

<table border="1">
<tr>
    <th>ชื่อเมนู</th>
    <th>จำนวน</th>
    <th>ราคา</th>
    <th>รวม</th>
    <th>ลบ</th>
</tr>

<?php
$total = 0;
$count = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        $res = $conn->query("SELECT * FROM food WHERE FoodID='$id'");
        $row = $res->fetch(PDO::FETCH_ASSOC);

        $sum = $row['price'] * $qty;
        $total += $sum;
        $count += $qty;
?>
<tr>
    <td><?= $row['Foodname'] ?></td>
    <td><?= $qty ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $sum ?></td>
    <td><a href="?remove=<?= $id ?>">❌</a></td>
</tr>
<?php }} ?>
</table>

<h3>จำนวนทั้งหมด: <?= $count ?> ชิ้น</h3>
<h3>ราคารวม: <?= $total ?> บาท</h3>

<br>
<a href="menu.php">⬅ กลับไปเลือกเมนู</a>
<a href="confirm.php"> ยืนยันคำสั่งซื้อ</a>
 หน้า confirm.php (บันทึกลง orders)
<?php include "connect.php"; session_start(); ?>

<?php
if (!empty($_SESSION['cart'])) {

    $orderID = "O" . rand(1000,9999);
    $customerID = "C001"; // ปรับให้เลือกจาก user จริง
    $date = date("Ymd");

    foreach ($_SESSION['cart'] as $foodID => $qty) {
        $sql = "INSERT INTO orders VALUES ('$orderID','$customerID','$foodID','$date')";
        $conn->query($sql);
    }

    unset($_SESSION['cart']);

    echo " สั่งอาหารสำเร็จ!";
}
?>
</body>
</html>