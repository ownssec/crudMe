<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';
require 'Student.php';

$id  = $_GET['id'] ?? 0;
$emp = $conn->query("SELECT * FROM students_table WHERE student_id=$id")->fetch_assoc();

if (!$emp) {
    die('Student not found');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create Student object and set new values
    $student = new Student();
    $student->setName(trim($_POST['student_name'] ?? ''));
    $student->setAge((int) ($_POST['student_age'] ?? 0));
    $student->setGender(trim($_POST['student_gender'] ?? ''));
    $student->setStatus(trim($_POST['student_status'] ?? ''));

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE students_table SET student_name=?, student_age=?, student_gender=?, student_status=? WHERE student_id=?");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters using getters from Student object
    $stmt->bind_param(
        'sissi',
        $student->getName(),
        $student->getAge(),
        $student->getGender(),
        $student->getStatus(),
        $id
    );

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Edit Minion – Payroll Pixie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <div class="card shadow">
        <div class="card-body">
          <h2 class="mb-4">Edit Minion</h2>
          <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Student Name</label>
              <input type="text" name="student_name" value="<?= htmlspecialchars($emp['student_name']); ?>" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Age</label>
              <input type="age" name="student_age" value="<?= htmlspecialchars($emp['student_age']); ?>" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label for="gender">Gender:</label>
              <select name="student_gender" id="gender" required class="form-control">
                <option value="">-- Select Gender --</option>
                <option value="male" <?= $emp['student_gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= $emp['student_gender'] === 'female' ? 'selected' : '' ?>>Female</option>
              </select>
            </div>

            <div class="col-md-12">
              <label for="status">Status:</label>
              <select name="student_status" id="status" required class="form-control">
                <option value="">-- Select Status --</option>
                <option value="active" <?= $emp['student_status'] === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $emp['student_status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
              </select>
            </div>
            <div class="col-12 text-end">
              <button class="btn btn-primary">Update</button>
              <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
