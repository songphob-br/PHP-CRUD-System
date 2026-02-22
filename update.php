<?php
// เรียกไฟล์เชื่อมต่อฐานข้อมูล
include 'db.php';

// รับค่าข้อมูลจากฟอร์ม (method="POST")
$id = $_POST['id'];               // id ของสินค้าที่ต้องการแก้ไข
$name = $_POST['name'];           // ชื่อสินค้า
$category = $_POST['category'];   // หมวดหมู่
$price = $_POST['price'];         // ราคา
$description = $_POST['description']; // รายละเอียดสินค้า

/* =========================
   ดึงชื่อรูปเดิมจากฐานข้อมูล
   ========================= */

// ค้นหารูปภาพเดิมของสินค้าตาม id
$result = $conn->query("SELECT img FROM products WHERE id = $id");

// ดึงข้อมูลออกมาเป็น array
$row = $result->fetch_assoc();

// เก็บชื่อรูปเดิมไว้
$old_img = $row['img'];

// ตั้งค่ารูปใหม่เริ่มต้นเป็นรูปเดิม (กรณีไม่มีการเปลี่ยนรูป)
$new_img = $old_img;

/* =========================
   ตรวจสอบว่ามีการอัปโหลดรูปใหม่หรือไม่
   ========================= */

if (!empty($_FILES['img']['name'])) {

  // ถ้ามีรูปเดิมอยู่ และไฟล์ยังมีอยู่ในโฟลเดอร์
  if ($old_img && file_exists("uploads/$old_img")) {

    // ลบไฟล์รูปเดิมออกก่อน
    unlink("uploads/$old_img");
  }

  // ดึงนามสกุลไฟล์ใหม่ เช่น jpg, png
  $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

  // ตั้งชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบัน ป้องกันชื่อซ้ำ
  $new_img = time() . "." . $ext;

  // ย้ายไฟล์จากโฟลเดอร์ชั่วคราวไปยัง uploads
  move_uploaded_file($_FILES['img']['tmp_name'], "uploads/" . $new_img);
}

/* =========================
   อัปเดตข้อมูลในฐานข้อมูล
   ========================= */

// สร้างคำสั่ง SQL สำหรับแก้ไขข้อมูลสินค้า
$sql = "UPDATE products SET
        name='$name',
        category='$category',
        price='$price',
        description='$description',
        img='$new_img'
        WHERE id=$id";

// สั่งให้ฐานข้อมูลทำการอัปเดตข้อมูล
$conn->query($sql);

// หลังแก้ไขเสร็จ กลับไปหน้า index
header("Location: index.php");
?>
