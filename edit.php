<?php
// รวมไฟล์การเชื่อมต่อฐานข้อมูลเพื่อใช้ $conn
include 'db.php';

// รับค่า id ของสินค้าที่ต้องการแก้ไขจากพารามิเตอร์ GET ใน URL
$id = $_GET['id'];

// สร้างคำสั่ง SQL เพื่อเลือกข้อมูลสินค้าจากตาราง products ที่มี id เท่ากับ $id
$result = $conn->query("SELECT * FROM products WHERE id = $id");

// ดึงข้อมูลแถวแรกจากผลลัพธ์ของ query และเก็บในตัวแปร $row
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แก้ไขสินค้า</title>
  <!-- ลิงก์ไปยัง CSS ของ Bootstrap สำหรับการออกแบบหน้าเว็บ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h3>✏️ แก้ไขสินค้า</h3>

  <!-- ฟอร์มสำหรับแก้ไขข้อมูลสินค้า ส่งไปยัง update.php ด้วย method POST และรองรับการอัปโหลดไฟล์ -->
  <form action="update.php" method="post" enctype="multipart/form-data">

    <!-- ฟิลด์ซ่อนสำหรับส่งค่า id ของสินค้าไปด้วย -->
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <div class="mb-3">
      <label class="form-label">ชื่อสินค้า</label>
      <!-- ช่องป้อนข้อมูลชื่อสินค้า มีค่าเริ่มต้นจากฐานข้อมูล และจำเป็นต้องกรอก -->
      <input type="text" name="name" class="form-control"
             value="<?= htmlspecialchars($row['name']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">หมวดหมู่</label>
      <!-- ช่องป้อนข้อมูลหมวดหมู่ มีค่าเริ่มต้นจากฐานข้อมูล -->
      <input type="text" name="category" class="form-control"
             value="<?= htmlspecialchars($row['category']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">ราคา (บาท)</label>
      <!-- ช่องป้อนข้อมูลราคา เป็นตัวเลข มีค่าเริ่มต้นจากฐานข้อมูล -->
      <input type="number" name="price" class="form-control"
             value="<?= $row['price'] ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">รายละเอียดสินค้า</label>
      <!-- ช่องป้อนข้อมูลรายละเอียด เป็น textarea มีค่าเริ่มต้นจากฐานข้อมูล -->
      <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($row['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">รูปปัจจุบัน</label><br>
      <!-- แสดงรูปภาพปัจจุบันของสินค้า ถ้ามี -->
      <?php if ($row['img']) { ?>
        <img src="uploads/<?= $row['img'] ?>" width="120" class="mb-2">
      <?php } else { ?>
        <!-- ถ้าไม่มีรูป แสดงข้อความ -->
        <div class="text-muted">ไม่มีรูป</div>
      <?php } ?>
    </div>

    <div class="mb-3">
      <label class="form-label">เปลี่ยนรูปใหม่ (ถ้าไม่เปลี่ยนให้เว้นไว้)</label>
      <!-- ช่องอัปโหลดไฟล์รูปใหม่ รองรับเฉพาะไฟล์ภาพ -->
      <input type="file" name="img" class="form-control" accept="image/*">
    </div>

    <!-- ปุ่มส่งฟอร์มเพื่ออัปเดตข้อมูล -->
    <button type="submit" class="btn btn-warning">อัปเดต</button>
    <!-- ลิงก์กลับไปยังหน้า index.php -->
    <a href="index.php" class="btn btn-secondary">กลับ</a>

  </form>
</div>

</body>
</html>
