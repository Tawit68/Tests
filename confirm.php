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
if (!empty($_SESSION['cart'])) {

    $orderID = "O" . rand(1000,9999);
    $customerID = "C001"; // ปรับให้เลือกจาก user จริง
    $date = date("Ymd");

    foreach ($_SESSION['cart'] as $foodID => $qty) {
        $sql = "INSERT INTO orders VALUES ('$orderID','$customerID','$foodID','$date')";
        $conn->query($sql);
    }

    unset($_SESSION['cart']);

    echo "-----อาหารสำเร็จ!";
}
?>
</body>
</html>