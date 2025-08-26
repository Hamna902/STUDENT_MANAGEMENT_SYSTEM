<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: read.php?msg=Student deleted successfully");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
