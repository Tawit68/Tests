<?php include "connect.php"; session_start(); ?>

<?php
// เพิ่มสินค้า
if (isset($_POST['add'])) {
    $id = $_POST['FoodID'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

// เพิ่มจำนวน
if (isset($_GET['plus'])) {
    $id = $_GET['plus'];
    $_SESSION['cart'][$id]++;
}

// ลดจำนวน
if (isset($_GET['minus'])) {
    $id = $_GET['minus'];
    if ($_SESSION['cart'][$id] > 1) {
        $_SESSION['cart'][$id]--;
    } else {
        unset($_SESSION['cart'][$id]);
    }
}

// ลบสินค้า
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}
?>

<h2> ตารางสั่งอาหาร</h2>

<table border="1">
<tr>
    <th>ชื่อเมนู</th>
    <th>จำนวน</th>
    <th>ราคา</th>
    <th>รวม</th>
    <th>จัดการ</th>
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
    <td>
        <a href="?plus=<?= $id ?>"></a>
        <a href="?minus=<?= $id ?>"></a>
        <a href="?remove=<?= $id ?>"></a>
    </td>
</tr>
<?php }} ?>
</table>

<h3>จำนวนทั้งหมด: <?= $count ?> ชิ้น</h3>
<h3>ราคารวม: <?= $total ?> บาท</h3>

<br>
<a href="menu.php"> กลับไปเลือกเมนู</a>
<a href="confirm.php"> ยืนยันคำสั่งซื้อ</a>