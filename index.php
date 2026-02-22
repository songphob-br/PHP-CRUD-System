<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>สินค้ามือสองของนักศึกษา</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <div class="navbar-nav mx-auto text-center">
      <h2 class="navbar-brand mb-0">ระบบจัดการสินค้ามือสองของนักศึกษา</h2>
    </div>
    <div class="navbar-nav ms-auto">
      <a href="add.php" class="btn btn-success navbar-btn">➕ เพิ่มสินค้า</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
 <div class="row g-4">

<?php
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
?>
  <div class="col-6 col-md-4 col-lg-3 mb-4">
  <div class="card shadow-sm h-100">

    <?php if (!empty($row['img'])) { ?>
      <img class="card-img-top" 
           src="uploads/<?= htmlspecialchars($row['img']) ?>" 
           alt="รูปสินค้า"
           style="height:160px; object-fit:cover;">
    <?php } else { ?>
      <img class="card-img-top" 
           src="uploads/no-image.png" 
           alt="ไม่มีรูป"
           style="height:160px; object-fit:cover;">
    <?php } ?>

    <div class="card-body p-2">
      <h6 class="card-title mb-1 text-truncate">
        <?= htmlspecialchars($row['name']) ?>
      </h6>

      <p class="text-danger fw-bold mb-1">
        ฿<?= number_format($row['price']) ?>
      </p>

      <p class="card-text small text-muted text-truncate">
        <?= htmlspecialchars($row['description']) ?>
      </p>

      <div class="d-flex justify-content-between mt-2">
        <a href="edit.php?id=<?= $row['id'] ?>" 
           class="btn btn-outline-warning btn-sm">แก้ไข</a>

        <a href="delete.php?id=<?= $row['id'] ?>" 
           class="btn btn-outline-danger btn-sm"
           onclick="return confirm('ยืนยันการลบสินค้า?')">ลบ</a>
      </div>
    </div>

  </div>
</div>


<?php
  }
} else {
?>
  <div class="col-12 text-center text-muted">
    ยังไม่มีสินค้า
  </div>
<?php } ?>

</div>


<footer>
  <div class="container">
    <input type="checkbox" id="checkbox">
    <label for="checkbox" class="label"></label>
  </div>
</footer>

</body>
</html>
