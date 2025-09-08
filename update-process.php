<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: update.php?id=$id&msg=Invalid email format");
        exit;
    }

    // Check for duplicate email
    $check = $conn->prepare("SELECT id FROM students WHERE email = ? AND id != ?");
    $check->bind_param("si", $email, $id);
    $check->execute();
    if ($check->get_result()->num_rows > 0) {
        header("Location: update.php?id=$id&msg=Error: Email already exists");
        exit;
    }

    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $course, $id);

    if ($stmt->execute()) {
        header("Location: read.php?msg=Student updated successfully!");
    } else {
        if ($conn->errno == 1062) {
            header("Location: update.php?id=$id&msg=Error: Email already exists");
        } else {
            header("Location: update.php?id=$id&msg=Error: Could not update student");
        }
    }
    $stmt->close();
}
?>