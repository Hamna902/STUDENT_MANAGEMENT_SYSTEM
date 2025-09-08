<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #2e026d, #5a189a, #9d4edd);
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
    }
    .container {
      margin-top: 60px;
    }
    h2 {
      font-weight: bold;
      color: #fff;
    }
    .table-container {
      background: #f8f9fa; 
      border-radius: 18px;
      padding: 2rem;
      box-shadow: 0px 8px 25px rgba(0,0,0,0.3);
    }
    .table thead {
      background: #5a189a;
      color: #fff;
      font-size: 1rem;
    }
    .table tbody tr {
      background: #fff;
      color: #333;
      transition: 0.3s;
    }
    .table tbody tr:hover {
      background: #e6d6fa;
      color: #000;
    }
    .btn {
      border-radius: 10px;
      font-weight: 500;
    }
    .btn-edit {
      background: #7b2cbf;
      color: #fff;
    }
    .btn-edit:hover {
      background: #5a189a;
    }
    .btn-delete {
      background: #ff4545ff;
      color: #fff;
    }
    .btn-delete:hover {
      background: #ff0000ff;
    }
    .btn-add {
      background: #5a189a;
      color: #fff;
      font-weight: 600;
    }
    .btn-add:hover {
      background: #7b2cbf;
    }
    .alert-purple {
  background: linear-gradient(90deg, #7b2cbf, #9d4edd);
  color: #fff;
  border-radius: 10px;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="text-center mb-4">
      <h2><i class="bi bi-people-fill"></i> Student Records</h2>
    </div>
   <?php if (isset($_GET['msg'])): ?>
  <div class="alert alert-purple text-center fw-bold shadow-sm">
    <i class="bi bi-info-circle-fill"></i> <?= $_GET['msg']; ?>
  </div>
<?php endif; ?>
    
    <div class="table-container">
      <div class="d-flex justify-content-between mb-3">
        <a href="create.php" class="btn btn-add">
          <i class="bi bi-person-plus-fill"></i> Add Student
        </a>
      </div>
      
      <table class="table table-hover table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col">#ID</th>
            <th scope="col"><i class="bi bi-person-fill"></i> Name</th>
            <th scope="col"><i class="bi bi-envelope-fill"></i> Email</th>
            <th scope="col"><i class="bi bi-book-fill"></i> Course</th>
            <th scope="col"><i class="bi bi-gear-fill"></i> Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $result = $conn->query("SELECT * FROM students ORDER BY id DESC");
          while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><?= $row['name']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['course']; ?></td>
              <td>
                <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-edit btn-sm">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure to delete?');">
                  <i class="bi bi-trash-fill"></i> Delete
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
