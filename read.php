<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --bg-gradient: linear-gradient(135deg, #2e026d, #5a189a, #9d4edd);
      --card-bg: #f8f9fa;
      --table-bg: #fff;
      --text-color: #333;
      --thead-bg: #5a189a;
      --thead-color: #fff;
      --tbody-hover: #e6d6fa;
      --btn-edit-bg: #7b2cbf;
      --btn-edit-hover: #5a189a;
      --btn-delete-bg: #ff4545;
      --btn-delete-hover: #ff0000;
      --btn-add-bg: #5a189a;
      --btn-add-hover: #7b2cbf;
      --alert-bg: linear-gradient(90deg, #7b2cbf, #9d4edd);
      --text-white: #fff;
    }
    [data-theme="dark"] {
      --bg-gradient: linear-gradient(135deg, #1a013f, #3a1069, #6d2f9a);
      --card-bg: #2c2c2c;
      --table-bg: #333;
      --text-color: #e0e0e0;
      --thead-bg: #3a1069;
      --thead-color: #e0e0e0;
      --tbody-hover: #4a4a4a;
      --btn-edit-bg: #9d4edd;
      --btn-edit-hover: #7b2cbf;
      --btn-delete-bg: #cc3333;
      --btn-delete-hover: #b30000;
      --btn-add-bg: #6d2f9a;
      --btn-add-hover: #9d4edd;
      --alert-bg: linear-gradient(90deg, #9d4edd, #6d2f9a);
      --text-white: #e0e0e0;
    }
    body {
      min-height: 100vh;
      background: var(--bg-gradient);
      font-family: 'Segoe UI', sans-serif;
      color: var(--text-white);
    }
    .container {
      margin-top: 60px;
    }
    h2 {
      font-weight: bold;
      color: var(--text-white);
    }
    .table-container {
      background: var(--card-bg);
      border-radius: 18px;
      padding: 2rem;
      box-shadow: 0px 8px 25px rgba(0,0,0,0.3);
    }
    .table thead {
      background: var(--thead-bg);
      color: var(--thead-color);
      font-size: 1rem;
    }
    .table tbody tr {
      background: var(--table-bg);
      color: var(--text-color);
      transition: 0.3s;
    }
    .table tbody tr:hover {
      background: var(--tbody-hover);
      color: var(--text-color);
    }
    .btn {
      border-radius: 10px;
      font-weight: 500;
    }
    .btn-edit {
      background: var(--btn-edit-bg);
      color: var(--text-white);
    }
    .btn-edit:hover {
      background: var(--btn-edit-hover);
    }
    .btn-delete {
      background: var(--btn-delete-bg);
      color: var(--text-white);
    }
    .btn-delete:hover {
      background: var(--btn-delete-hover);
    }
    .btn-add {
      background: var(--btn-add-bg);
      color: var(--text-white);
      font-weight: 600;
    }
    .btn-add:hover {
      background: var(--btn-add-hover);
    }
    .alert-purple {
      background: var(--alert-bg);
      color: var(--text-white);
      border-radius: 10px;
    }
    .search-form {
      max-width: 400px;
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
  <div class="container">
    <div class="text-center mb-4">
      <h2><i class="bi bi-people-fill"></i> Student Records</h2>
    </div>
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-purple text-center fw-bold shadow-sm">
        <i class="bi bi-info-circle-fill"></i> <?= htmlspecialchars($_GET['msg']); ?>
      </div>
    <?php endif; ?>
    
    <div class="table-container">
      <div class="d-flex justify-content-between mb-3">
        <a href="create.php" class="btn btn-add">
          <i class="bi bi-person-plus-fill"></i> Add Student
        </a>
        <form method="GET" class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name, email, or course" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
          </div>
        </form>
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
          $limit = 5;
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $offset = ($page - 1) * $limit;
          $search = isset($_GET['search']) ? $_GET['search'] : '';
          
          // Count total records for pagination
          $countSql = "SELECT COUNT(*) as total FROM students WHERE name LIKE ? OR email LIKE ? OR course LIKE ?";
          $countStmt = $conn->prepare($countSql);
          $searchTerm = "%$search%";
          $countStmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
          $countStmt->execute();
          $totalRecords = $countStmt->get_result()->fetch_assoc()['total'];
          $totalPages = ceil($totalRecords / $limit);
          
          // Fetch paginated records
          $sql = "SELECT * FROM students WHERE name LIKE ? OR email LIKE ? OR course LIKE ? ORDER BY id ASC LIMIT ? OFFSET ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("sssii", $searchTerm, $searchTerm, $searchTerm, $limit, $offset);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><?= htmlspecialchars($row['name']); ?></td>
              <td><?= htmlspecialchars($row['email']); ?></td>
              <td><?= htmlspecialchars($row['course']); ?></td>
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
      
      <!-- Pagination -->
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($search); ?>">Previous</a>
          </li>
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($search); ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
          <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($search); ?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>
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