<?php 
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: read.php?msg=Invalid student ID");
    exit;
}
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id LIMIT 1");
if ($result->num_rows == 0) {
    header("Location: read.php?msg=Student not found");
    exit;
}
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
  <button class="btn btn-light theme-toggle" onclick="toggleTheme()">
    <i class="bi bi-moon-fill"></i> Toggle Dark Mode
  </button>
  <div class="card">
    <h2 class="text-center mb-4 update"><i class="bi bi-pencil-square"></i> Update Student</h2>
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-purple text-center fw-bold shadow-sm">
        <i class="bi bi-info-circle-fill"></i> <?= htmlspecialchars($_GET['msg']); ?>
      </div>
    <?php endif; ?>
    <form action="update-process.php" method="POST">
      <input type="hidden" name="id" value="<?= $student['id']; ?>">
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-person-fill"></i> Full Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-book-fill"></i> Course</label>
        <input type="text" name="course" class="form-control" value="<?= htmlspecialchars($student['course']); ?>" required>
      </div>
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-update">
          <i class="bi bi-check-circle-fill"></i> Update
        </button>
        <a href="read.php" class="btn btn-back">
          <i class="bi bi-arrow-left-circle"></i> Back
        </a>
      </div>
    </form>
  </div>
<script src="script.js"></script>
</body>
</html>