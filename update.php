<?php 
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id LIMIT 1");
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #2e026d, #5a189a, #9d4edd);
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
    }
    .card {
      background: #f8f9fa;
      border-radius: 18px;
      box-shadow: 0px 8px 25px rgba(0,0,0,0.3);
      padding: 2rem;
      width: 420px;
    }
    h2 {
      font-weight: bold;
      color: #5a189a;
    }
    .form-label {
      font-weight: 600;
      color: #333;
    }
    .form-control {
      border-radius: 10px;
      background: #fff;
      border: 2px solid #9d4edd;
      color: #333;
    }
    .form-control:focus {
      border-color: #7b2cbf;
      box-shadow: 0 0 0 0.25rem rgba(157, 78, 221, 0.3);
    }
    .btn {
      border-radius: 12px;
      font-weight: 600;
    }
    .btn-update {
      background: linear-gradient(45deg, #7b2cbf, #5a189a);
      color: #fff;
      border: none;
    }
    .btn-update:hover {
      opacity: 0.9;
    }
    .btn-back {
      background: #9d4edd;
      color: #fff;
    }
    .btn-back:hover {
      background: #7b2cbf;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2 class="text-center mb-4"><i class="bi bi-pencil-square"></i> Update Student</h2>
    <form action="update-process.php" method="POST">
      <input type="hidden" name="id" value="<?= $student['id']; ?>">
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-person-fill"></i> Full Name</label>
        <input type="text" name="name" class="form-control" value="<?= $student['name']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
        <input type="email" name="email" class="form-control" value="<?= $student['email']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label"><i class="bi bi-book-fill"></i> Course</label>
        <input type="text" name="course" class="form-control" value="<?= $student['course']; ?>" required>
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
</body>
</html>
