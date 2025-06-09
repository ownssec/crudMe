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
            <h1>Student Registry System<small>Students</small></h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Student name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Status</th>
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="text-end">
               <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</body>

</html>
