<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';
$result = $conn->query("SELECT * FROM students_table ORDER BY student_id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payroll Cast– Employee Cash Dispatcher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }

        h1 small {
            font-size: 16px;
            display: block;
            margin-top: 4px;
            color: #6c757d;
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Payroll Cast<small>Employee Cash Dispatcher</small></h1>
            <a href="add_student.php" class="btn btn-success">➕ Hire & Pay</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Salary (₱)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['student_id']; ?></td>
                            <td><?= htmlspecialchars($row['student_name']); ?></td>
                            <td><?= number_format($row['student_age']); ?></td>
                            <td><?= htmlspecialchars($row['student_gender'], 2); ?></td>
                            <td><?= htmlspecialchars($row['student_status'], 2); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="edit_student.php?id=<?= $row['student_id']; ?>" class="btn btn-sm btn-primary">✏️</a>
                                    <a href="delete_student.php?id=<?= $row['student_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Fire this minion?');">🗑️</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
