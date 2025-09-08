<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="style_read.css">
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
<script src="script_read.js"></script>
</body>
</html>