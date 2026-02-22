<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แก้ไขสินค้า</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h3>✏️ แก้ไขสินค้า</h3>

  <form action="update.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <div class="mb-3">
      <label class="form-label">ชื่อสินค้า</label>
      <input type="text" name="name" class="form-control"
             value="<?= htmlspecialchars($row['name']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">หมวดหมู่</label>
      <input type="text" name="category" class="form-control"
             value="<?= htmlspecialchars($row['category']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">ราคา (บาท)</label>
      <input type="number" name="price" class="form-control"
             value="<?= $row['price'] ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">รายละเอียดสินค้า</label>
      <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($row['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">รูปปัจจุบัน</label><br>
      <?php if ($row['img']) { ?>
        <img src="uploads/<?= $row['img'] ?>" width="120" class="mb-2">
      <?php } else { ?>
        <div class="text-muted">ไม่มีรูป</div>
      <?php } ?>
    </div>

    <div class="mb-3">
      <label class="form-label">เปลี่ยนรูปใหม่ (ถ้าไม่เปลี่ยนให้เว้นไว้)</label>
      <input type="file" name="img" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-warning">อัปเดต</button>
    <a href="index.php" class="btn btn-secondary">กลับ</a>

  </form>
</div>

</body>
</html>
