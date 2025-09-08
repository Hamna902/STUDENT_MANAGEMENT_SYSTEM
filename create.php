<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style_create.css">
</head>
<body>
  <button class="btn btn-light theme-toggle" onclick="toggleTheme()">
    <i class="bi bi-moon-fill"></i> Toggle Dark Mode
  </button>
  <div class="card">
    <h2 class="text-center mb-4"><i class="bi bi-person-plus-fill"></i> Add Student</h2>
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-purple text-center fw-bold shadow-sm">
        <i class="bi bi-info-circle-fill"></i> <?= htmlspecialchars($_GET['msg']); ?>
      </div>
    <?php endif; ?>
    <form action="insert.php" method="POST">
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-person-fill"></i> Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
      </div>
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
      </div>
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-book-fill"></i> Course</label>
        <input type="text" name="course" class="form-control" placeholder="Enter course" required>
      </div>
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-save">
          <i class="bi bi-save-fill"></i> Save
        </button>
        <a href="read.php" class="btn btn-back">
          <i class="bi bi-arrow-left-circle"></i> Back
        </a>
      </div>
    </form>
  </div>
<script src="script_create.js"></script>
</body>
</html>