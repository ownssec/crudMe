<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';  // $conn must be a valid MySQLi object
require 'Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $student = new Student();
    $student->setName(trim($_POST['student_name'] ?? ''));
    $student->setAge((int) ($_POST['student_age'] ?? 0));
    $student->setGender(trim($_POST['student_gender'] ?? ''));
    $student->setStatus(trim($_POST['student_status'] ?? ''));


    if (
        $student->getName()   === '' ||
        $student->getAge()    <= 0   ||
        $student->getGender() === '' ||
        $student->getStatus() === ''
    ) {
        die('All fields are required, and age must be > 0.');
    }

    $stmt = $conn->prepare(
        'INSERT INTO students_table (student_name, student_age, student_gender, student_status)
         VALUES (?,?,?,?)'
    );
    if (!$stmt) { die('Prepare failed: ' . $conn->error); }

    $stmt->bind_param(
        'siss',                       // s = string, i = int, s = string, s = string
        $student->getName(),
        $student->getAge(),
        $student->getGender(),
        $student->getStatus()
    );
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();

    header('Location: index.php');    // back to list
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Hire & Pay – Payroll Pixie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container py-5  w-25">
      <div class="card shadow">
        <div class="card-body">
          <h2 class="mb-4">Hire & Pay</h2>
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Student Name</label>
              <input type="text" name="student_name" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Age</label>
              <input type="number" name="student_age" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="gender">Gender:</label>
              <select name="student_gender" id="gender" required class="form-control">
                <option value="">-- Select Gender --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="col-md-12">
             <label for="status">Status:</label>
              <select name="student_status" id="status" required class="form-control">
                <option value="">-- Select Gender --</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <div class="col-12 text-end">
              <button class="btn btn-success">Save</button>
              <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
