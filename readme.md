# 🎓 Student Management System (PHP + MySQL)

A simple **CRUD application** built with **PHP, MySQL, and Bootstrap**.  
This project demonstrates how to create, read, update, and delete student records from a database.

---

## 📌 Features
- **Create:** Add new student records with Name, Email, and Course.
- **Read:** View all students in a table.
- **Update:** Edit existing student details.
- **Delete:** Remove student records with confirmation.
- **Bootstrap Styling:** Modern, responsive design with gradient theme.

---

## 📂 Project Structure
```text
STUDENT_MANAGEMENT_SYSTEM/
│── db.php # Database connection
│── create.php # Form to add student
│── insert.php # Logic to insert student data
│── read.php # Display student records 
│── update.php # Form to edit student
│── update-process.php # Logic to update student
│── delete.php # Logic to delete student
```


---

## 🛠️ Setup Instructions

### 1️⃣ Create Database
Run the following SQL in **phpMyAdmin** or **MySQL CLI**:

```
sql
CREATE DATABASE student_db;

USE student_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL
);
```
### 2️⃣ Configure Database Connection

1- Open db.php and set your credentials:

```
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "student_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
### 3️⃣ Run the Project

1-Place the project folder inside htdocs (if using XAMPP) or www (if using WAMP).

2-Start Apache and MySQL services.

3-Open in browser:
http://localhost/student_management_system/read.php

---

## 🎨 UI Preview

1- Student Record
![Student Record](images/student_record.png)  
2-Add Student Record
![Add Student Record ](images/add_student_record.png)  
3-Update Student Record
![Update Student Record](images/update_record.png)  

---

## 👨‍💻 Author

HAMNA NAZAR

---