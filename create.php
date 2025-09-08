<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --bg-gradient: linear-gradient(135deg, #2e026d, #5a189a, #9d4edd);
      --card-bg: #f8f9fa;
      --text-color: #333;
      --label-color: #333;
      --input-border: #9d4edd;
      --input-focus: #7b2cbf;
      --btn-save-bg: linear-gradient(45deg, #7b2cbf, #5a189a);
      --btn-back-bg: #9d4edd;
      --btn-back-hover: #7b2cbf;
      --alert-bg: linear-gradient(90deg, #7b2cbf, #9d4edd);
      --text-white: #fff;
    }
    [data-theme="dark"] {
      --bg-gradient: linear-gradient(135deg, #1a013f, #3a1069, #6d2f9a);
      --card-bg: #2c2c2c;
      --text-color: #e0e0e0;
      --label-color: #e0e0e0;
      --input-border: #6d2f9a;
      --input-focus: #9d4edd;
      --btn-save-bg: linear-gradient(45deg, #9d4edd, #7b2cbf);
      --btn-back-bg: #6d2f9a;
      --btn-back-hover: #9d4edd;
      --alert-bg: linear-gradient(90deg, #9d4edd, #6d2f9a);
      --text-white: #e0e0e0;
    }
    body {
      min-height: 100vh;
      background: var(--bg-gradient);
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
      color: var(--text-white);
    }
    .card {
      background: var(--card-bg);
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
      color: var(--label-color);
    }
    .form-control {
      border-radius: 10px;
      background: var(--card-bg);
      border: 2px solid var(--input-border);
      color: var(--text-color);
    }
    .form-control:focus {
      border-color: var(--input-focus);
      box-shadow: 0 0 0 0.25rem rgba(157, 78, 221, 0.3);
      color: var(--text-color);
    }
    .btn {
      border-radius: 12px;
      font-weight: 600;
    }
    .btn-save {
      background: var(--btn-save-bg);
      color: var(--text-white);
      border: none;
    }
    .btn-save:hover {
      opacity: 0.9;
    }
    .btn-back {
      background: var(--btn-back-bg);
      color: var(--text-white);
    }
    .btn-back:hover {
      background: var(--btn-back-hover);
    }
    .alert-purple {
      background: var(--alert-bg);
      color: var(--text-white);
      border-radius: 10px;
    }
    .theme-toggle {
      position: fixed;
      top: 20px;
      right: 20px;
    }
  </style>
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
  <script>
    function toggleTheme() {
      const body = document.body;
      const currentTheme = body.getAttribute('data-theme');
      if (currentTheme === 'dark') {
        body.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
      } else {
        body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
      }
    }
    // Apply saved theme on page load
    if (localStorage.getItem('theme') === 'dark') {
      document.body.setAttribute('data-theme', 'dark');
    }
  </script>
</body>
</html>