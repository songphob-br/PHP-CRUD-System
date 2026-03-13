<?php
// รวมไฟล์การเชื่อมต่อฐานข้อมูลเพื่อใช้ $conn
include 'db.php';
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>สินค้ามือสองของนักศึกษา</title>
  <!-- ลิงก์ไปยัง CSS ของ Bootstrap สำหรับการออกแบบหน้าเว็บ -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- ลิงก์ไปยังไฟล์ CSS เองสำหรับสไตล์เพิ่มเติม -->
  <link rel="stylesheet" href="css.css">
</head>

<body>
  <!-- แถบนำทางด้านบนของหน้าเว็บ -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
      <div class="navbar-nav mx-auto text-center">
        <h2 class="navbar-brand mb-0">ระบบจัดการสินค้ามือสองของนักศึกษา</h2>
      </div>
      <div class="navbar-nav ms-auto">
        <!-- ลิงก์ไปยังหน้าเพิ่มสินค้า -->
        <a href="add.php" class="btn btn-success navbar-btn">➕ เพิ่มสินค้า</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row g-4">

      <?php
      // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลสินค้าทั้งหมด รวมกับชื่อผู้ใช้จากตาราง users และเรียงตาม id ล่าสุดก่อน
      $result = $conn->query("
                                      SELECT products.*, users.username
                                      FROM products
                                      JOIN users ON products.user_id = users.id
                                      ORDER BY products.id DESC");

      // ตรวจสอบว่ามีผลลัพธ์หรือไม่
      if ($result->num_rows > 0) {
        // วนลูปเพื่อแสดงข้อมูลแต่ละแถว
        while ($row = $result->fetch_assoc()) {
          ?>
          <!-- การ์ดแสดงข้อมูลสินค้าแต่ละรายการ -->
          <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card shadow-sm h-100">

              <!-- แสดงรูปภาพสินค้า ถ้ามี หรือแสดงรูปไม่มีภาพ -->
              <?php if (!empty($row['img'])) { ?>
                <img class="card-img-top" src="uploads/<?= htmlspecialchars($row['img']) ?>" alt="รูปสินค้า"
                  style="height:160px; object-fit:cover;">
              <?php } else { ?>
                <img class="card-img-top" src="uploads/no-image.png" alt="ไม่มีรูป" style="height:160px; object-fit:cover;">
              <?php } ?>

              <div class="card-body p-2">
                <!-- ชื่อสินค้า -->
                <h6 class="card-title mb-1 text-truncate">
                  <?= htmlspecialchars($row['name']) ?>
                </h6>

                <!-- ราคาสินค้า -->
                <p class="text-danger fw-bold mb-1">
                  ฿<?= number_format($row['price']) ?>
                </p>

                <!-- รายละเอียดสินค้า -->
                <p class="card-text small text-muted text-truncate">
                  <?= htmlspecialchars($row['description']) ?>
                </p>
                <!-- ชื่อผู้ขาย -->
                <p class="small text-muted mb-1">
                  ผู้ขาย: <?= htmlspecialchars($row['username']) ?>
                </p>

                <!-- ปุ่มแก้ไขและลบ -->
                <div class="d-flex justify-content-between mt-2">
                  <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-outline-warning btn-sm">แก้ไข</a>

                  <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('ยืนยันการลบสินค้า?')">ลบ</a>
                </div>
              </div>

            </div>
          </div>


          <?php
        }
      } else {
        // ถ้าไม่มีสินค้า แสดงข้อความแจ้งเตือน
        ?>
        <div class="col-12 text-center text-muted">
          ยังไม่มีสินค้า
        </div>
      <?php } ?>

    </div>


    <!-- ส่วนท้ายของหน้าเว็บ -->
    <footer>
      <div class="container">
        <!-- checkbox และ label สำหรับการสลับธีมหรือฟีเจอร์อื่น -->
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="label"></label>
      </div>
    </footer>

</body>

</html>