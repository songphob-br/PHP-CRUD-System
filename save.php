<?php
include 'db.php';
// รับค่าข้อมูลจากฟอร์ม (method="POST")
$name = $_POST['name'];           // ชื่อสินค้า
$category = $_POST['category'];   // หมวดหมู่สินค้า
$price = $_POST['price'];         // ราคาสินค้า
$description = $_POST['description']; // รายละเอียดสินค้า

// กำหนดตัวแปรเก็บชื่อรูปภาพ เริ่มต้นเป็นค่าว่าง
$img_name = "";
/* =========================
   ส่วนอัปโหลดรูปภาพ
   ========================= */

// ตรวจสอบว่ามีการเลือกรูปภาพหรือไม่
if (!empty($_FILES['img']['name'])) {

  // ดึงนามสกุลไฟล์ เช่น jpg, png
  $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

  // ตั้งชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบัน (time())
  // เพื่อป้องกันชื่อไฟล์ซ้ำ
  $img_name = time() . "." . $ext;

  // ย้ายไฟล์จากโฟลเดอร์ชั่วคราว ไปยังโฟลเดอร์ uploads
  move_uploaded_file($_FILES['img']['tmp_name'], "uploads/" . $img_name);
}

/* =========================
   บันทึกข้อมูลลงฐานข้อมูล
   ========================= */

$sql = "INSERT INTO products (name, category, price, description, img)
        VALUES ('$name', '$category', '$price', '$description', '$img_name')";

// สั่งให้ฐานข้อมูลทำงานตามคำสั่ง SQL
$conn->query($sql);

header("Location: index.php");
?>
