<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $course, $id);

    if ($stmt->execute()) {
        header("Location: read.php?msg=Student updated successfully!");
    } else {
        header("Location: read.php?msg=Error: Could not update student");
    }
}
