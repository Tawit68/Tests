<?php include "connect.php"; ?> 
<!-- //เรียกไฟล์ connect.php เข้ามาใช้ ในไฟล์นี้ต้องมี $conn = new mysqli(...) สําคัญ -->

<?php
if (isset($_POST['submit'])) { //เช็คว่า “มีการกดปุ่ม submit หรือยัง”
    $id = $_POST['CustomerID'];
    $fname = $_POST['Firstname'];  //รับค่าจาก input ใน form
    $lname = $_POST['Lastname']; //รับค่าจาก input ใน form
    $phone = $_POST['Phonenumber'];//รับค่าจาก input ใน form
    $address = $_POST['Address']; //รับค่าจาก input ใน form

    $sql = "INSERT INTO customer VALUES ('$id','$fname','$lname','$phone','$address')"; //สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงตาราง customer
    $conn->query($sql); 
    // //ใช้ $conn ส่งคำสั่ง SQL ไปที่ MySQL

    echo "เพิ่มลูกค้าสำเร็จ <a href='menu.php'>ไปสั่งอาหาร</a>"; // แสดงข้อความว่าเพิ่มสำเร็จ
}
?>

<form method="POST">  
    <!-- // สร้างฟอร์มส่งข้อมูลแบบ POSTข้อมูลจะถูกส่งกลับมาหน้าเดิม -->
    ID: <input name="CustomerID"><br> 
    <!-- name ต้องตรงกับ $_POST[...] -->
    ชื่อ: <input name="Firstname"><br>
    นามสกุล: <input name="Lastname"><br>
    เบอร์: <input name="Phonenumber"><br>
    ที่อยู่: <input name="Address"><br>
    <button name="submit">บันทึก</button>
    <!-- <button name="submit">บันทึก</button> -->
</form>