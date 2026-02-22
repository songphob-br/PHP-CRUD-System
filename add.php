<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เพิ่มสินค้า</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h3>➕ เพิ่มสินค้ามือสอง</h3>

  <!-- สำคัญ: enctype -->
  <form action="save.php" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label class="form-label">ชื่อสินค้า</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">หมวดหมู่</label>
      <input type="text" name="category" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">ราคา (บาท)</label>
      <input type="number" name="price" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">รายละเอียดสินค้า</label>
      <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">รูปสินค้า</label>
      <input type="file" name="img" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-success">บันทึก</button>
    <a href="index.php" class="btn btn-secondary">กลับ</a>

  </form>
</div>

</body>
</html>
